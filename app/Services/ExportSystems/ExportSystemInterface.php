<?php

namespace App\Services\ExportSystems;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;

interface ExportSystemInterface
{

    public function params();

    public function getBalance();

    public function createOrder(Order $order, OrderItem $orderItem);

    public function checkOrders(Collection $orders);

    public function getServices();
}
