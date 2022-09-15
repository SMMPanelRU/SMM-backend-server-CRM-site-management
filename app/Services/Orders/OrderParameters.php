<?php

namespace App\Services\Orders;

use App\Enum\Orders\OrderStatusEnum;
use App\Models\PaymentSystem;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Collection;

class OrderParameters
{
    private User                   $user;
    private Site                   $site;
    private PaymentSystem          $paymentSystem;
    private OrderStatusEnum        $status;
    private float                  $amount;
    private float                  $discount;
    private Collection   $items;
    private array $details;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): OrderParameters
    {
        $this->user = $user;

        return $this;
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    public function setSite(Site $site): OrderParameters
    {
        $this->site = $site;

        return $this;
    }

    public function getPaymentSystem(): PaymentSystem
    {
        return $this->paymentSystem;
    }

    public function setPaymentSystem(PaymentSystem $paymentSystem): OrderParameters
    {
        $this->paymentSystem = $paymentSystem;

        return $this;
    }

    public function getStatus(): OrderStatusEnum
    {
        return $this->status;
    }

    public function setStatus(OrderStatusEnum $status): OrderParameters
    {
        $this->status = $status;

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): OrderParameters
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): OrderParameters
    {
        $this->discount = $discount;

        return $this;
    }


    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setItems(Collection $items): OrderParameters
    {
        $this->items = $items;

        return $this;
    }

    public function getDetails(): array
    {
        return $this->details;
    }


    public function setDetails($details): OrderParameters
    {
        $this->details = $details;

        return $this;
    }


}
