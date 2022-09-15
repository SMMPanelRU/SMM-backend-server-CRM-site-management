<?php

namespace App\Services\ExportSystems;

interface ExportSystemInterface
{

    public function params();

    public function getBalance();

    public function createOrder();

    public function checkOrders();

    public function getServices();
}
