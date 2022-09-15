<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function toArray($request): array
    {
        /** @var Product $product */
        $product = $this->resource;

        return [
            'id'                => $product->id,
            'name'              => $product->name,
            'description'       => $product->description,
            'short_description' => $product->short_description,
            'categories'        => $product->categories,
            'attributes'        => $product->attributes,
        ];
    }
}
