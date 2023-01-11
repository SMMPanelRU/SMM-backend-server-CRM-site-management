<?php

namespace App\Http\Requests\Api\Orders;

use App\Enum\Orders\OrderStatusEnum;
use App\Models\Category;
use App\Models\Order;
use App\Models\Site;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class OrderRequest extends FormRequest {

    protected $stopOnFirstFailure = true;
    public Collection $orders;
    public Site $site;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'search' => [
                'sometimes',
                'nullable',
                Rule::exists(Order::class, 'id')
            ],
            'category_id' => [
                'sometimes',
                'nullable',
                Rule::exists(Category::class, 'id')
            ],
        ];
    }

}
