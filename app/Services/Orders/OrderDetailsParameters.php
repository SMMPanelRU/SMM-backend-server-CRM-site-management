<?php

namespace App\Services\Orders;

use App\Enum\Orders\OrderStatusEnum;
use App\Models\PaymentSystem;
use App\Models\Site;
use App\Models\User;

class OrderDetailsParameters
{
    private string $key;
    private string $value;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     *
     * @return OrderDetailsParameters
     */
    public function setKey(string $key): OrderDetailsParameters
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return OrderDetailsParameters
     */
    public function setValue(string $value): OrderDetailsParameters
    {
        $this->value = $value;

        return $this;
    }

}
