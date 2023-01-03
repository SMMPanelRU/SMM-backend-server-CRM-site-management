<?php

namespace App\Http\Resources;

use App\Models\PaymentSystem;
use App\Models\Product;
use App\Services\SiteContainer;
use App\Traits\EntityAttributeTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentSystemResource extends JsonResource {

    use EntityAttributeTrait;

    private int $id;
    private mixed $name;
    private mixed $slug;
    private array $attributes;

    public function __construct(PaymentSystem $paymentSystem) {
        parent::__construct($paymentSystem);

        $site = app(SiteContainer::class)->getSite();

        $attributes = $this->attributesToArray($paymentSystem);

        $this->id = $paymentSystem->id;
        $this->name = $paymentSystem->name;
        $this->slug = $paymentSystem->slug;
        $this->attributes = $attributes;
    }

    public function toArray($request): array {

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'attributes'        => $this->attributes,
        ];
    }
}
