<?php

namespace App\Http\Livewire\Pages\Users;

use App\Enum\DefaultStatusEnum;
use App\Exceptions\Users\InsufficientFundsException;
use App\Models\Attribute;
use App\Models\ManualOrder;
use App\Models\Site;
use App\Models\User;
use App\Services\UserService;
use App\Traits\EntityAttributeTrait;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class UserEdit extends Component
{

    use EntityAttributeTrait;

    public ?User      $user                     = null;
    public bool       $deleteLoading            = false;
    public Collection $allAttributes;
    public array      $attr                     = [];
    public Collection $allSites;
    public array      $sites                    = [];
    public ?float     $balanceChangeValue       = null;
    public ?string    $balanceChangeDescription = null;


    public function rules()
    {

        return [
            'user.name'                => 'sometimes',
            'user.email'               => 'required',
            'user.status'              => [
                'required',
                new Enum(DefaultStatusEnum::class),
            ],
            'balanceChangeValue'       => 'nullable|numeric|not_in:0',
            'balanceChangeDescription' => 'nullable|string|required_with:balanceChangeValue',
            'attr.*'                   => 'sometimes',
            'sites.*'                  => 'sometimes',
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

    public function updateBalance()
    {

        $this->validate();

        if ($this->balanceChangeValue === null) {
            $this->addError('balanceChangeValue', 'empty');

            return false;
        }

        if ($this->balanceChangeDescription === null) {
            $this->addError('balanceChangeValue', 'empty');

            return false;
        }

        if (($this->user->balance?->balance ?? 0) + $this->balanceChangeValue < 0) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => __('errors.insufficient funds')]);

            return false;
        }
        $manualOrder = new ManualOrder();
        $manualOrder->user()->associate($this->user);
        $manualOrder->amount      = $this->balanceChangeValue;
        $manualOrder->description = $this->balanceChangeDescription;
        $manualOrder->admin()->associate(Auth::user());
        $manualOrder->save();

        try {
            (new UserService($this->user))->updateBalance($manualOrder, $this->balanceChangeValue, $this->balanceChangeDescription);
        } catch (InsufficientFundsException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        $this->balanceChangeValue = null;
        $this->balanceChangeDescription = null;
        $this->user->refresh();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('text.balance was updated')]);

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
