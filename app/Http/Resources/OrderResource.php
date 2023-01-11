<?php

namespace App\Http\Resources;

use App\Enum\Orders\OrderStatusEnum;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class OrderResource extends JsonResource
{

    private int $id;
    private OrderStatusEnum $status;
    private $products;
    private $createdAt;
    private $updatedAt;
    private float $amount;
    private string $url;

    private ?string $paymentForm = '';

    public function __construct(Order $order)
    {
        parent::__construct($order);

        $this->id = $order->id;
        $this->status = $order->status;
        $this->createdAt = $order->created_at->toDateTimeString();
        $this->updatedAt = $order->updated_at->toDateTimeString();

        $products = new Collection();
        foreach ($order->products as $product) {
            $tmpProduct = $product->product;
            $tmpProduct->orderCount = $product->count;
            $products->add($tmpProduct);
        }

        $this->products = ProductResource::collection($products);

        $this->url = $order->details()->where('key', 'url')->first()->value;

        $this->amount = $order->paymentAmount();

        if ($order->paymentForm ?? null) {
            $this->paymentForm = $order->paymentForm;
        }
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'products' => $this->products,
            'url' => $this->url,
            'amount' => $this->amount,
            'paymentForm' => $this->paymentForm,
        ];
    }
}
