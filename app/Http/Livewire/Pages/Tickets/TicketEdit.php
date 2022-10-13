<?php

namespace App\Http\Livewire\Pages\Tickets;

use App\Enum\Tickets\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\TicketAnswer;
use App\Traits\EntityAttributeTrait;
use Livewire\Component;
use Livewire\WithFileUploads;

class TicketEdit extends Component
{

    use WithFileUploads, EntityAttributeTrait;

    public Ticket $ticket;
    public array  $answer = [];

    public function rules()
    {

        return [
            'ticket.status' => 'required|numeric',
            'answer.body'   => 'sometimes|nullable',
        ];
    }

    public function boot()
    {
    }

    /**
     * @throws \Throwable
     */
    public function render()
    {
        return view('livewire.pages.tickets.edit');
    }

    public function addTicketAnswer()
    {
        $this->validate();

        if ($this->ticket->status === TicketStatusEnum::Closed) {
            $this->ticket->closed_at = now();
        } elseif (!empty($this->answer['body'])) {
            $this->ticket->status = TicketStatusEnum::WaitUser;
        }

        $this->ticket->save();

        if ($this->answer['body'] ?? null) {
            $tickerAnswer = new TicketAnswer();
            $tickerAnswer->ticket()->associate($this->ticket);
            $tickerAnswer->admin()->associate(\Auth::user());
            $tickerAnswer->body = $this->answer['body'];
            $tickerAnswer->save();

            $this->redirect(route('tickets.edit', ['ticket' => $this->ticket->id]));
        }

    }

    public function submit(): bool
    {

        $this->validate();


        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

}
