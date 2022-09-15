<?php

namespace App\Http\Livewire\Pages\Faqs;


use App\Models\Faq;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class FaqItem extends Component
{

    public Faq  $faq;
    public bool $deleteLoading = false;

    public function rules()
    {
        return [
            'faq.status'  => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.pages.faqs.item');
    }

    public function updated(): bool
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }


        $this->faq->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete(Faq $faq)
    {
        $this->deleteLoading = true;

        $faq->delete();

        $this->emitUp('refreshFaqs');

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);
    }
}
