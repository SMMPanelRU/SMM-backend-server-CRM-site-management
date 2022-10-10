<?php

namespace App\Http\Livewire\Pages\Users;

use App\Enum\DefaultStatusEnum;
use App\Models\User;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class UserItem extends Component
{

    public User $user;
    public bool $deleteLoading = false;

    public function rules()
    {
        return [
            'user.status' => [
                'required',
                new Enum(DefaultStatusEnum::class),
            ],
        ];
    }

    public function render()
    {

        return view('livewire.pages.users.item');
    }


}
