<?php

namespace App\Actions\Order;

use App\Models\DiscountProduct;
use App\Services\Orders\OrderParameters;
use Closure;
use Illuminate\Support\Facades\Log;

class OrderDiscountAction
{
    public function handle(OrderParameters $orderParameters, Closure $next)
    {

        $site = $orderParameters->getSite();

        $orderAmount = 0;
        $orderDiscount = 0;

        foreach ($orderParameters->getItems() as $item) {
            /* @var \App\Services\Orders\OrderItemsParameters $item */

            $product = $item->getProduct();
            $productPrice = $product->price($site->id)->first();

            if ($productPrice === null) {
                //todo add to debug info product without price
                continue;
            }

            $price = $productPrice->price * $item->getCount();

            $orderAmount += $price;

            $productDiscounts = $item->getDiscounts();
            if ($productDiscounts ?? null) {
                foreach ($productDiscounts as $productDiscount) {
                    $model = $productDiscount['entity'];
                    /* @var DiscountProduct $model */
                    $discount = round($price * $model->discount / 100, 2);
                    $orderDiscount += $discount;

                }
            }
        }

        $discounts = $orderParameters->getDiscounts();

        if ($discounts ?? null) {
            foreach ($discounts as $discount) {

            }
        }

        $orderParameters->setAmount($orderAmount);
        $orderParameters->setDiscount($orderDiscount);

        return $next($orderParameters);
    }
}
