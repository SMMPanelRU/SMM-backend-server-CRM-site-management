<?php

namespace App\Services\ExportSystems\Socgress;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\ExportSystems\BaseExportSystem;
use App\Services\ExportSystems\Exceptions\ErrorResponseException;
use App\Services\ExportSystems\ExportSystemInterface;
use App\Services\ExportSystems\ExportSystemProductsParameters;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;

class SocgressExportSystem extends BaseExportSystem implements ExportSystemInterface
{
    public static string $name        = 'Socgress';
    public static string $description = 'Socgress apiV2';
    public string        $apiUrl      = 'https://socgress.com/api/v2';

    public function params(): array
    {
        return [
            'api_key' => [
                'type'        => 'text',
                'secret'      => true,
                'description' => __('export_system.Api_key'),
            ],
        ];
    }

    /**
     * @throws \App\Services\ExportSystems\Exceptions\ErrorResponseException
     */
    public function getBalance(): float
    {
        $data = [
            'action' => 'balance',
            'key'    => $this->settings['api_key'],
        ];
        try {
            $response = $this->client->get('', [RequestOptions::QUERY => $data]);
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            throw new ErrorResponseException($response, $e);
        }

        $jsonBody = json_decode($response->getBody()->getContents());

        return (float) $jsonBody->balance ?? 0;
    }

    public function createOrder(Order $order, OrderItem $orderItem)
    {
        // TODO: Implement createOrder() method.
    }

    public function checkOrders(Collection $orders)
    {
        // TODO: Implement checkOrders() method.
    }

    public function getServices(): Collection
    {
        $data = [
            'action' => 'services',
            'key'    => $this->settings['api_key'],
        ];
        try {
            $response = $this->client->get('', [RequestOptions::QUERY => $data]);
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            throw new ErrorResponseException($response, $e);
        }

        $jsonBody = json_decode($response->getBody()->getContents());

        $products = new Collection();

        foreach ($jsonBody as $item) {
            $exportSystemProduct = new ExportSystemProductsParameters();
            $exportSystemProduct->setUniqueId($item->service);
            $exportSystemProduct->setName($item->name . ' ' . $item->category);
            $exportSystemProduct->setPrice($item->rate);
            $exportSystemProduct->setMin($item->min);
            $exportSystemProduct->setMax($item->max);
            $exportSystemProduct->setData($item);

            $products->add($exportSystemProduct);
        }

        return $products;
    }
}
