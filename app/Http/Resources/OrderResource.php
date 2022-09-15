<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    private int $id;

    public function __construct(Order $order)
    {
        parent::__construct($order);

        $this->id = $order->id;
    }

    public function toArray($request): array
    {

        return [
            'id' => $this->id,
        ];
    }
}
