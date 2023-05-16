<?php

namespace App\Http\Requests\Users;

use App\Enum\DefaultStatusEnum;
use App\Models\Site;
use App\Models\User;
use App\Services\SiteContainer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class RegisterRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;
    public Site $site;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|gt:0',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email:strict',
                'max:255',
            ],
            'password' => 'required|string|min:8',
            'profile' => 'array',
            'profile.name' => [
                'sometimes',
                'nullable',
                'string',
                'min:3',
                'max:50',
            ],
            'profile.surname' => [
                'sometimes',
                'nullable',
                'string',
                'min:3',
                'max:50',
            ],
            'profile.phone' => [
                'sometimes',
                'nullable',
                'string',
                'min:3',
                'max:50',
            ],
        ];
    }

    public function withValidator($validator)
    {
        $site = app(SiteContainer::class)->getSite();

        $this->site = $site;

        $validator->after(function ($validator) use ($site) {
            /* @var \Illuminate\Validation\Validator $validator */

            if ($validator->messages()->isNotEmpty()) {
                return;
            }

            $userExist = User::query()->where(['site_id' => $site->id, 'status' => DefaultStatusEnum::ON])->
            where(function ($q) use ($validator) {
                return $q->where(['name' => $validator->validated()['name']])->orWhere(['email' => $validator->validated()['email']]);
            })->exists();

            if ($userExist) {
                $validator->errors()->add('user', 'exist');
                return;
            }
        });
    }

}
