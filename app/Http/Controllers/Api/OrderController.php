<?php

namespace App\Http\Controllers\Api;

use App\Actions\Order\CheckPaymentMethodAction;
use App\Actions\Order\CreateOrderAction;
use App\Actions\Order\OrderDiscountAction;
use App\Actions\Order\OrderFillExportSystemAction;
use App\Actions\Order\ProductDiscountAction;
use App\Enum\Orders\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Orders\OrderRequest;
use App\Http\Requests\Order\NewOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\PaymentSystem;
use App\Services\Orders\OrderDetailsParameters;
use App\Services\Orders\OrderItemsParameters;
use App\Services\Orders\OrderParameters;
use App\Services\PaymentSystems\BasePaymentSystem;
use App\Services\SiteContainer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(OrderRequest $request): AnonymousResourceCollection
    {

        $site = app(SiteContainer::class)->getSite();

        $user = Auth::user();

        $orders = $user->orders()->orderBy('id', 'desc')->get();

        return OrderResource::collection(
            $orders
        );
    }

    public function create(NewOrderRequest $request)
    {

        $orderParameters = new OrderParameters();
        $orderParameters->setStatus(OrderStatusEnum::New);
        $orderParameters->setUser(\Auth::user());
        $orderParameters->setSite($request->site);
        $orderParameters->setPaymentSystem(PaymentSystem::query()->find($request->validated('payment_system_id')));

        $items = new Collection();

        foreach ($request->products as $product) {
            $itemParameters = new OrderItemsParameters();
            $itemParameters->setProduct($product);
            $itemParameters->setCount($request->counts[$product->id]);
            $items->add($itemParameters);
        }
        $orderParameters->setItems($items);

        $details = new OrderDetailsParameters();

        $details->setKey('url');
        $details->setValue($request->get('url'));

        $orderParameters->setDetails([$details]);

        try {
            app(Pipeline::class)
                ->send($orderParameters)
                ->through([
                    ProductDiscountAction::class,
                    OrderDiscountAction::class,
                    OrderFillExportSystemAction::class,
                    CheckPaymentMethodAction::class,
                    CreateOrderAction::class,
                ])
                ->thenReturn();
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }


        $order = new Order();
        $order->user()->associate($orderParameters->getUser());
        $order->site()->associate($orderParameters->getSite());
        $order->paymentSystem()->associate($orderParameters->getPaymentSystem());
        $order->amount   = $orderParameters->getAmount();
        $order->discount = $orderParameters->getDiscount();
        $order->status   = $orderParameters->getStatus();
        $order->save();

        foreach ($orderParameters->getItems() as $productParameters) {

            /* @var \App\Services\Orders\OrderItemsParameters $productParameters */
            $product = [
                'order_id'=>$order->id,
                'product_id'=>$productParameters->getProduct()->id,
                'count'=>$productParameters->getCount(),
                'export_system_product_id'=>$productParameters->getExportSystemProduct()->id,
            ];

            $order->products()->forceCreate($product);

            $productDiscounts = $productParameters->getDiscounts();

            if ($productDiscounts ?? null) {
                foreach ($productDiscounts as $productDiscount) {
                    $discount = [
                        'order_id'=>$order->id,
                        'product_id'=>$productParameters->getProduct()->id,
                        'entity_type'=>$productDiscount['entity_type'],
                        'entity_id'=>$productDiscount['entity_id'],
                    ];
                    $order->discounts()->forceCreate($discount);
                }
            }
        }

        foreach ($orderParameters->getDetails() as $orderDetailParameters) {

            /* @var \App\Services\Orders\OrderDetailsParameters $orderDetailParameters */

            $detail = [
                'key'=>$orderDetailParameters->getKey(),
                'value'=>$orderDetailParameters->getValue(),
            ];

            $order->details()->forceCreate($detail);
        }

        $paymentSystem = $orderParameters->getPaymentSystem();

        try {
            $paymentHandler = (new BasePaymentSystem())->getInstance($paymentSystem->handler);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }

        if ($paymentHandler::$isNoFormPayment === true) {
            $paymentHandler->payForOrder($order);

            $order->status = OrderStatusEnum::Paid;
            $order->save();
        } else {
            $order->paymentForm = $paymentHandler->paymentForm($order);
        }

        return new OrderResource($order);
    }
}
