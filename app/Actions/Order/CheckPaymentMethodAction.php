<?php

namespace App\Actions\Order;

use App\Enum\DefaultStatusEnum;
use App\Services\Orders\OrderParameters;
use App\Services\PaymentSystems\BasePaymentSystem;
use Closure;

class CheckPaymentMethodAction
{
    public function handle(OrderParameters $orderParameters, Closure $next)
    {

        $paymentSystem = $orderParameters->getPaymentSystem();

        try {
            $handler = (new BasePaymentSystem())->getInstance($paymentSystem->handler);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }

        if ($handler::$isNoFormPayment === true) {
            if (!$handler->canPay($orderParameters->getUser(), $orderParameters->getAmount())) {
                throw new \Exception(__('payment_system.low_balance'));
            }
        }

        return $next($orderParameters);
    }
}

