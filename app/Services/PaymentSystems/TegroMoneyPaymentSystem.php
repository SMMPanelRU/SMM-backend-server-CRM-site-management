<?php

namespace App\Services\PaymentSystems;

use App\Models\Order;

class TegroMoneyPaymentSystem extends BasePaymentSystem implements PaymentSystemInterface
{
    public static string $name        = 'TegroMoney';
    public static string $description = 'Pay from TegroMoney';
    public static bool $isNoFormPayment = false;

    public function params(): array
    {
        return [];
    }

    public function paymentForm(Order $order): string
    {
        return '<button type="submit">Pay '.$order->paymentAmount().'</button>';
    }
}
