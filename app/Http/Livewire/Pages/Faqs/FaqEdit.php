<?php

namespace App\Http\Livewire\Pages\Faqs;

use App\Models\Faq;
use App\Models\Site;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FaqEdit extends Component
{

    public ?Faq       $faq           = null;
    public bool       $deleteLoading = false;
    public Collection $allSites;
    public array      $sites         = [];

    public function rules()
    {

        return [
            'faq.question.en' => 'required',
            'faq.question.ru' => 'required',
            'faq.answer.en'   => 'required',
            'faq.answer.ru'   => 'required',
            'faq.status'      => 'required|numeric',
            'sites.*'         => 'sometimes',
        ];
    }

    public function boot()
    {
        $this->allSites = Site::query()->get();

        if (!$this->faq) {
            $this->faq = new Faq();
        }
    }

    /**
     * @throws \Throwable
     */
    public function render()
    {
        if ($this->faq ?? null) {
            $this->sites = $this->faq->sites()->pluck('site_id')->toArray();
        }

        return view('livewire.pages.faqs.edit');
    }

    public function submit(): bool
    {

        $this->validate();

        $this->faq->save();

        $this->faq->sites()->sync($this->sites);

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete()
    {
        $this->deleteLoading = true;

        $this->faq->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('faqs'));
    }
}
