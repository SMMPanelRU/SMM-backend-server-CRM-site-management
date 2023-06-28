<?php

namespace App\Actions\Order;

use App\Models\DiscountProduct;
use App\Services\Orders\OrderParameters;
use Closure;
use Illuminate\Support\Facades\Log;

class ProductDiscountAction
{
    public function handle(OrderParameters $orderParameters, Closure $next)
    {

        foreach ($orderParameters->getItems() as $item) {
            /* @var \App\Services\Orders\OrderItemsParameters $item */
            $product = $item->getProduct();
            $count = $item->getCount();

            $discountProduct = DiscountProduct::query()->where(['product_id' => $product->id])->where('count', '>=', $count)->orderBy('count', 'asc')->first();

            if ($discountProduct === null) {
                continue;
            }

            $item->addDiscount($discountProduct);

        }

        return $next($orderParameters);
    }
}
