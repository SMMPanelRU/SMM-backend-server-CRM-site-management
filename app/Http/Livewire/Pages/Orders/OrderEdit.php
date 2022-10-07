<?php

namespace App\Http\Livewire\Pages\Orders;

use App\Models\Attribute;
use App\Models\Order;
use App\Models\Site;
use App\Traits\EntityAttributeTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class OrderEdit extends Component
{

    use WithFileUploads, EntityAttributeTrait;

    public ?Order      $order          = null;
    public Collection $allAttributes;
    public array      $attr          = [];
    public Collection $allSites;
    public array      $sites         = [];


    public function rules()
    {

        return [
            'order.status'               => 'required|numeric',
            'attr.*'                    => 'sometimes',
            'sites.*'                   => 'sometimes',
        ];
    }

    public function boot()
    {
        $this->allSites      = Site::query()->get();
        $this->allAttributes = Attribute::query()->where('entity_type', Order::class)->get();
    }

    /**
     * @throws \Throwable
     */
    public function render()
    {
        if ($this->order === null) {
            abort(404);
        }

        return view('livewire.pages.orders.edit');
    }

    public function submit(): bool
    {

        $this->validate();

        if (!empty($this->attr)) {
            $this->updateEntityAttributes($this->order, $this->attr);
        }

        $this->order->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

}
