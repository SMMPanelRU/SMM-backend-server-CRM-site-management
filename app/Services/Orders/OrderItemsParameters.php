<?php

namespace App\Services\Orders;

use App\Models\ExportSystem;
use App\Models\ExportSystemProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;

class OrderItemsParameters
{
    private Order $order;
    private Product $product;
    private int                 $count;
    private ExportSystemProduct $exportSystemProduct;
    private ?Collection $discounts = null;


    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): OrderItemsParameters
    {
        $this->order = $order;

        return $this;
    }


    public function getProduct(): Product
    {
        return $this->product;
    }


    public function setProduct(Product $product): OrderItemsParameters
    {
        $this->product = $product;

        return $this;
    }


    public function getCount(): int
    {
        return $this->count;
    }


    public function setCount(int $count): OrderItemsParameters
    {
        $this->count = $count;

        return $this;
    }

    public function getExportSystemProduct(): ExportSystemProduct
    {
        return $this->exportSystemProduct;
    }


    public function setExportSystemProduct(ExportSystemProduct $exportSystemProduct): OrderItemsParameters
    {
        $this->exportSystemProduct = $exportSystemProduct;

        return $this;
    }


    public function addDiscount($entity): OrderItemsParameters
    {

        if ($this->discounts === null) {
            $this->discounts = new Collection();
        }

        $this->discounts->add([
            'entity' => $entity,
            'entity_type' => get_class($entity),
            'entity_id' => $entity->getKey(),
        ]);

        return $this;
    }

    public function getDiscounts(): ?Collection
    {
        return $this->discounts;
    }
}
