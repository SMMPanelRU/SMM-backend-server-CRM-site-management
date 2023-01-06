<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    private int $id;
    private ?string $paymentForm = '';

    public function __construct(Order $order)
    {
        parent::__construct($order);

        $this->id = $order->id;

        if ($order->paymentForm ?? null) {
            $this->paymentForm = $order->paymentForm;
        }
    }

    public function toArray($request): array
    {

        return [
            'id' => $this->id,
            'paymentForm'=>$this->paymentForm,
        ];
    }
}
