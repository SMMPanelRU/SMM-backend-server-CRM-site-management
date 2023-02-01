<?php

namespace App\Http\Resources;

use App\Models\Page;
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
    private array $attributes;

    public function __construct(Page $page) {
        parent::__construct($page);

        $site = app(SiteContainer::class)->getSite();

        $attributes = $this->attributesToArray($page);

        $this->id = $page->id;
        $this->name = $page->name;
        $this->slug = $page->slug;
        $this->description = $page->description;
        $this->short_description = $page->short_description;
        $this->attributes = $attributes;
    }

    public function toArray($request): array {

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'short_description' => $this->short_description,
            'attributes'        => $this->attributes,
        ];
    }
}
