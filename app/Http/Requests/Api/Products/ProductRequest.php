<?php

namespace App\Http\Requests\Api\Products;

use App\Models\Category;
use App\Models\Site;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest {

    protected $stopOnFirstFailure = true;
    public Collection $products;
    public array $counts;
    public Site $site;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'category_id' => [
                'sometimes',
                Rule::exists(Category::class, 'id')
            ],
        ];
    }

}
