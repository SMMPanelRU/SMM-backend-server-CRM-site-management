<?php

namespace App\Http\Livewire\Pages\Tickets;


use App\Models\Page;
use App\Models\Ticket;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class TicketItem extends Component
{

    public Ticket $ticket;

    public function rules()
    {

        return [
            'ticket.status' => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.pages.tickets.item');
    }

    public function updated(): bool
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        $this->ticket->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

}
