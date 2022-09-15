<?php

namespace App\Http\Requests\Order;

use App\Enum\DefaultStatusEnum;
use App\Models\PaymentSystem;
use App\Models\Product;
use App\Models\Site;
use App\Services\SiteContainer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class NewOrderRequest extends FormRequest
{

    protected         $stopOnFirstFailure = true;
    public Collection $products;
    public array      $counts;
    public Site       $site;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'url'               => 'required|url',
            'payment_system_id' => [
                'required',
                Rule::exists('payment_systems', 'id')->where(function ($query) {
                    $query->where('status', DefaultStatusEnum::ON);
                }),
            ],
            'items.*'           => 'required|array',
        ];
    }

    public function withValidator($validator)
    {

        $site = app(SiteContainer::class)->getSite();

        $this->site = $site;

        $products = new Collection();

        $validator->after(function ($validator) use ($site, $products) {
            /* @var \Illuminate\Validation\Validator $validator */

            if ($validator->messages()->isNotEmpty()) {
                return;
            }

            foreach ($validator->validated()['items'] as $key => $requestItem) {
                $product = Product::query()->forSite($site)->with('attributes')->find($requestItem['id']);
                if ($product === null) {
                    $validator->errors()->add('items.' . $key, "Item not found");
                    continue;
                }

                if ($product->attributes ?? null) {
                    foreach ($product->attributes as $attr) {
                        if ($attr->attribute->slug === 'min_count' && (int) $attr->non_translatable_value > (int) $requestItem['count']) {
                            $validator->errors()->add('items.' . $key, "Min count - {$attr->non_translatable_value}");
                            continue;
                        }
                        if ($attr->attribute->slug === 'max_count' && (int) $attr->non_translatable_value < (int) $requestItem['count']) {
                            $validator->errors()->add('items.' . $key, "Max count - {$attr->non_translatable_value}");
                        }
                    }
                }

                $products->add($product);

                $this->counts[$requestItem['id']] = $requestItem['count'];

            }

        });

        $this->products = $products;

    }
}
