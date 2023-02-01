<?php

namespace App\Services\PaymentSystems;

use App\Models\Order;

class TegroMoneyPaymentSystem extends BasePaymentSystem implements PaymentSystemInterface
{
    public static string $name = 'TegroMoney';
    public static string $description = 'Pay from TegroMoney';
    public static bool $isNoFormPayment = false;

    public function params(): array
    {
        return [
            'shop_id' => [
                'type' => 'text',
                'secret' => false,
                'description' => __('payment_systems.shop_id'),
            ],
            'currency' => [
                'type' => 'text',
                'secret' => false,
                'description' => __('payment_systems.currency'),
            ],
            'secret' => [
                'type' => 'text',
                'secret' => true,
                'description' => __('payment_systems.secret'),
            ],
            'api_key' => [
                'type' => 'text',
                'secret' => true,
                'description' => __('payment_systems.api_key'),
            ],
        ];
    }

    public function paymentForm(Order $order): string
    {
        $data = [
            'shop_id' => $this->settings['shop_id'],
            'amount' => $order->paymentAmount(),
            'order_id' => $order->id,
            'currency' => $this->settings['currency'],
        ];

        $data['sign'] = $this->generatePaymentSign($data);

        return $this->generateHtmlForm('https://tegro.money/pay/', 'post', $data);

    }

    private function generatePaymentSign($data): string
    {
        return implode('.', $data);
    }

}
