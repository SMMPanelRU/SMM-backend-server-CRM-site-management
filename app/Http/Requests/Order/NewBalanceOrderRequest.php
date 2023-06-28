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

class NewBalanceOrderRequest extends FormRequest
{

    protected         $stopOnFirstFailure = true;
    public Site       $site;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'payment_system_id' => [
                'required',
                Rule::exists('payment_systems', 'id')->where(function ($query) {
                    $query->where('status', DefaultStatusEnum::ON);
                }),
            ],
            'amount'           => 'required|numeric',
        ];
    }

    public function withValidator($validator)
    {

        $site = app(SiteContainer::class)->getSite();

        $this->site = $site;

    }
}
