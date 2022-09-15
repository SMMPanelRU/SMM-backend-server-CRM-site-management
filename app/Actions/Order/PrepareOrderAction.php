<?php

namespace App\Actions\Order;

use App\Models\Order;
use Closure;

class PrepareOrderAction
{
    public function handle(Order $order, Closure $next)
    {

        return $next($order);
    }
}
