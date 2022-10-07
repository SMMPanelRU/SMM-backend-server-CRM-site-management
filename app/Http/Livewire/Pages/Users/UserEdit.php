<?php

namespace App\Http\Livewire\Pages\Users;

use App\Models\Attribute;
use App\Models\Site;
use App\Models\User;
use App\Traits\EntityAttributeTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UserEdit extends Component
{

    use EntityAttributeTrait;

    public ?User      $user          = null;
    public bool       $deleteLoading = false;
    public Collection $allAttributes;
    public array      $attr          = [];
    public Collection $allSites;
    public array      $sites         = [];


    public function rules()
    {

        return [
            'user.name'  => 'sometimes',
            'user.email' => 'required',
            'attr.*'     => 'sometimes',
            'sites.*'    => 'sometimes',
        ];
    }

    public function boot()
    {

        $this->allSites      = Site::query()->get();
        $this->allAttributes = Attribute::query()->where('entity_type', User::class)->get();

    }

    /**
     * @throws \Throwable
     */
    public function render()
    {

        if ($this->user === null) {
            abort(404);
        }

        return view('livewire.pages.users.edit');
    }

    public function submit(): bool
    {

        $this->validate();

        if (!empty($this->attr)) {
            $this->updateEntityAttributes($this->user, $this->attr);
        }

        $this->user->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete()
    {
        $this->deleteLoading = true;

        $this->user->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('users'));
    }
}
