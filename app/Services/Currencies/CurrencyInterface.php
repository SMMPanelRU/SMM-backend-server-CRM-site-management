<?php

namespace App\Services\Currencies;

interface CurrencyInterface
{
    public function getCourse(): float;
}
