<?php

namespace App\Actions\Order;

use App\Services\Orders\OrderParameters;
use Closure;

class CreateOrderAction
{
    public function handle(OrderParameters $orderParameters, Closure $next)
    {
        return $next($orderParameters);
    }
}

