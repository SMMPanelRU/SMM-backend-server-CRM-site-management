<?php

namespace App\Http\Resources;

use App\Enum\Orders\OrderStatusEnum;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class BalanceOrderResource extends JsonResource
{

    private int $id;
    private OrderStatusEnum $status;
    private $createdAt;
    private $updatedAt;
    private float $amount;
    private ?string $paymentForm = '';

    public function __construct(Order $order)
    {
        parent::__construct($order);

        $this->id = $order->id;
        $this->status = $order->status;
        $this->createdAt = $order->created_at->toDateTimeString();
        $this->updatedAt = $order->updated_at->toDateTimeString();

        $this->amount = $order->paymentAmount();

        if ($order->paymentForm ?? null) {
            $this->paymentForm = $order->paymentForm;
        }
    }

    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'status'      => $this->status,
            'createdAt'   => $this->createdAt,
            'updatedAt'   => $this->updatedAt,
            'amount'      => $this->amount,
            'paymentForm' => $this->paymentForm,
        ];
    }
}
