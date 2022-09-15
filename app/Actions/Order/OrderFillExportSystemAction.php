<?php

namespace App\Actions\Order;

use App\Models\ExportSystemProduct;
use App\Services\Orders\OrderParameters;
use Closure;

class OrderFillExportSystemAction
{
    public function handle(OrderParameters $orderParameters, Closure $next)
    {

        foreach ($orderParameters->getItems() as $item) {
            /* @var \App\Services\Orders\OrderItemsParameters $item */
            $item->setExportSystemProduct(ExportSystemProduct::query()->find(1));
        }
        $orderParameters->setDiscount(0);

        return $next($orderParameters);
    }
}
