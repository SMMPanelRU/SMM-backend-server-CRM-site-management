<?php

namespace App\Services\Currencies;

class RubCurrencyService extends BaseCurrency implements CurrencyInterface
{
    public static string $name        = 'RUB';
    public static string $description = 'RUB';

    public function getCourse(): float
    {
        return 1;
    }

}
