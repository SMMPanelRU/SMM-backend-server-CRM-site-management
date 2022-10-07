<?php

namespace App\Http\Livewire\Pages\Users;

use App\Models\User;
use Livewire\Component;

class UserItem extends Component
{

    public User $user;
    public bool $deleteLoading = false;

    public function rules()
    {
        return [];
    }

    public function render()
    {

        return view('livewire.pages.users.item');
    }


}
