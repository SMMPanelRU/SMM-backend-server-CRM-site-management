<?php

namespace App\Http\Livewire\Pages\Orders;


use App\Models\Order;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class OrderItem extends Component
{

    use WithFileUploads;

    public Order $order;
    public bool $deleteLoading = false;

    public function rules()
    {

        return [
            'order.status'  => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.pages.orders.item');
    }

    public function updated(): bool
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        $this->order->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

}
