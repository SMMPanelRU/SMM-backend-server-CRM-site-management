<?php

namespace App\Http\Livewire\Pages\Pages;


use App\Models\Page;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class PageItem extends Component
{

    use WithFileUploads;

    public Page $page;
    public      $logo;
    public      $uploadedLogo;
    public bool $deleteLoading = false;

    public function rules()
    {

        return [
            'logo'         => 'nullable|image|max:1024',
            'page.name.en' => 'required',
            'page.name.ru' => 'required',
            'page.slug'    => 'required',
            'page.status'  => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.pages.pages.item');
    }

    public function updated(): bool
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        if ($this->logo ?? null) {
            $this->uploadedLogo       = $this->logo->store('images/pages', 'public');
            $this->page->logo = $this->uploadedLogo;
        }

        $this->page->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete(Page $page)
    {
        $this->deleteLoading = true;

        if ($page->logo ?? null) {
            Storage::disk('public')->delete($page->logo);
        }

        $page->delete();

        $this->emitUp('refreshPages');

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);
    }
}
