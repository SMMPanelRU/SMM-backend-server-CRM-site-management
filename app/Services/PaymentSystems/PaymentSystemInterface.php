<?php

namespace App\Services\PaymentSystems;

use App\Models\Order;
use App\Models\User;

interface PaymentSystemInterface
{
    public function canPay(User $user, float $amount);

    public function paymentForm(Order $order);
}
