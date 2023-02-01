<?php

namespace App\Services\ExportSystems\Justanotherpanel;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\ExportSystems\BaseExportSystem;
use App\Services\ExportSystems\Exceptions\CreateExportException;
use App\Services\ExportSystems\Exceptions\ErrorResponseException;
use App\Services\ExportSystems\ExportSystemInterface;
use App\Services\ExportSystems\ExportSystemProductsParameters;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;

class JustanotherpanelExportSystem extends BaseExportSystem implements ExportSystemInterface
{
    public static string $name = 'JAP';
    public static string $description = 'JAP apiV2';
    public string $apiUrl = 'https://justanotherpanel.com/api/v2';

    public function params(): array
    {
        return [
            'api_key' => [
                'type' => 'text',
                'secret' => true,
                'description' => __('export_system.Api_key'),
            ],
        ];
    }

    /**
     * @throws ErrorResponseException
     */
    public function getBalance(): float
    {
        $data = [
            'action' => 'balance',
            'key' => $this->settings['api_key'],
        ];
        try {
            $response = $this->client->post('', [RequestOptions::FORM_PARAMS => $data]);
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            throw new ErrorResponseException($response, $e);
        }

        $jsonBody = json_decode($response->getBody()->getContents());

        return (float)$jsonBody->balance ?? 0;
    }

    public function createOrder(Order $order, \App\Models\OrderItem $orderItem)
    {
        $link = $order->details()->where('key', 'url')->value;
        $data = [
            'action' => 'add',
            'key' => $this->settings['api_key'],
            'service' => $orderItem->product->exportSystemProduct->unique_id,
            'link' => $link,
            'quantity' => $orderItem->count,
        ];
        try {
            $response = $this->client->post('', [RequestOptions::FORM_PARAMS => $data]);
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            throw new ErrorResponseException($response, $e);
        }

        $jsonBody = json_decode($response->getBody()->getContents());

        if ($jsonBody->order ?? null) {
            throw new CreateExportException("Cant get order id");
        }

        return (int)$jsonBody->order;
    }

    public function checkOrders(Collection $orders)
    {
        $ordersIds = [];
        foreach ($orders as $order) {
            /** @var OrderItem $order */
            $ordersIds[] = $order->export_order_id;
        }

        $ordersComma = implode(',', $ordersIds);
        $data = [
            'action' => 'status',
            'key' => $this->settings['api_key'],
            'orders' => $ordersComma,
        ];

        try {
            $response = $this->client->post('', [RequestOptions::FORM_PARAMS => $data]);
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            throw new ErrorResponseException($response, $e);
        }

        $jsonBody = json_decode($response->getBody()->getContents(), true);

        return $jsonBody;
    }

    public function getServices(): Collection
    {
        $data = [
            'action' => 'services',
            'key' => $this->settings['api_key'],
        ];
        try {
            $response = $this->client->post('', [RequestOptions::FORM_PARAMS => $data]);
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            throw new ErrorResponseException($response, $e);
        }

        $jsonBody = json_decode($response->getBody()->getContents());

        $products = new Collection();

        foreach ($jsonBody as $item) {
            $exportSystemProduct = new ExportSystemProductsParameters();
            $exportSystemProduct->setUniqueId($item->service);
            $exportSystemProduct->setName($item->name.' '.$item->category);
            $exportSystemProduct->setPrice($item->rate);
            $exportSystemProduct->setMin($item->min);
            $exportSystemProduct->setMax($item->max);
            $exportSystemProduct->setData($item);

            $products->add($exportSystemProduct);
        }

        return $products;
    }
}
