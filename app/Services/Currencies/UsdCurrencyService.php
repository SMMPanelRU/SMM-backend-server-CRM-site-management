<?php

namespace App\Services\Currencies;

use GuzzleHttp\Client;

class UsdCurrencyService extends BaseCurrency implements CurrencyInterface
{
    public static string $name        = 'USD';
    public static string $description = 'USD';

    public function getCourse(): float
    {

        try {
            $response = (new Client())->get('https://www.cbr.ru/scripts/XML_daily.asp');
        } catch (\Throwable)
        {
            throw new \Exception('Cant load page');
        }

        $result = simplexml_load_string($response->getBody()->getContents());

        foreach ($result as $item)
        {
            if ((string) $item->CharCode === self::$name) {
                return (float) str_replace(',', '.', $item->Value);
            }
        }

        throw new \Exception('Course not found');
    }

}
