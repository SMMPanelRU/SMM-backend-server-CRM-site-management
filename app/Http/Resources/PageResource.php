<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Services\SiteContainer;
use App\Traits\EntityAttributeTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource {

    use EntityAttributeTrait;

    private int $id;
    private mixed $name;
    private mixed $slug;
    private mixed $description;
    private mixed $short_description;
    private int $sort;
    private int $multiplicity;
    private array $categories;
    private array $prices;
    private array $discounts;
    private array $attributes;

    public function __construct(Product $product) {
        parent::__construct($product);

        $site = app(SiteContainer::class)->getSite();

        $attributes = $this->attributesToArray($product);

        $this->id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->short_description = $product->short_description;
        $this->sort = $product->sort;
        $this->attributes = $attributes;
    }

    public function toArray($request): array {

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'short_description' => $this->short_description,
            'sort'              => $this->sort,
            'attributes'        => $this->attributes,
        ];
    }
}
