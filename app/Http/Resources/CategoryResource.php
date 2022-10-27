<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Services\SiteContainer;
use App\Traits\EntityAttributeTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    use EntityAttributeTrait;

    private int    $id;
    private mixed  $name;
    private int    $sort;
    private ?int   $parent;
    private string $slug;
    private mixed  $description;
    private mixed  $short_description;
    private array  $attributes;

    public function __construct(Category $category)
    {
        parent::__construct($category);

        $site = app(SiteContainer::class)->getSite();

        $attributes = $this->attributesToArray($category);

        $this->id         = $category->id;
        $this->name       = $category->name;
        $this->sort       = $category->sort;
        $this->parent     = $category->category_id;
        $this->slug       = $category->slug;
        $this->attributes = $attributes;
    }

    public function toArray($request): array
    {

        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'sort'       => $this->sort,
            'parent'     => $this->parent,
            'slug'       => $this->slug,
            'attributes' => $this->attributes,
        ];
    }
}
