<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Services\Orders\OrderParameters;
use Closure;

class OrderDiscountAction
{
    public function handle(OrderParameters $orderParameters, Closure $next)
    {

        $orderParameters->setDiscount(0);

        return $next($orderParameters);
    }
}
