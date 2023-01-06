<?php

namespace App\Services\PaymentSystems;

use App\Exceptions\Users\InsufficientFundsException;
use App\Models\ManualOrder;
use App\Models\Order;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\DB;

class BalancePaymentSystem extends BasePaymentSystem implements PaymentSystemInterface
{
    public static string $name        = 'Balance';
    public static string $description = 'Pay from balance';
    public static bool $isNoFormPayment = true;

    public function params(): array
    {
        return [];
    }

    public function paymentForm(Order $order): string
    {
        return '';
    }

    public function canPay(User $user, float $amount): bool
    {
        if ($user?->balance?->balance >= $amount) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public function payForOrder(Order $order): void
    {
        try {
            (new UserService($order->user))->updateBalance($order, -$order->paymentAmount(), 'Payment for order '.$order->id);
        } catch (InsufficientFundsException $e) {
            throw new Exception(__($e->getMessage()));
        }
    }
}
