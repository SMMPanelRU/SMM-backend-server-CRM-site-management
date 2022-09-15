<?php

namespace App\Actions\Order;

use App\Services\Orders\OrderParameters;
use Closure;

class CreateOrderAction
{
    public function handle(OrderParameters $orderParameters, Closure $next)
    {

        $amount = 0;
        foreach ($orderParameters->getItems() as $item) {
            /* @var \App\Services\Orders\OrderItemsParameters $item */

            $product = $item->getProduct();

            $amount += $product->price / $product->multiplicity  * $item->getCount();
        }

        $orderParameters->setAmount($amount);

        return $next($orderParameters);
    }
}
