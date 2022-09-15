<?php

namespace App\Http\Livewire\Pages\Pages;

use App\Models\Attribute;
use App\Models\Page;
use App\Models\Site;
use App\Traits\EntityAttributeTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class PageEdit extends Component
{

    use WithFileUploads, EntityAttributeTrait;

    public ?Page      $page          = null;
    public            $logo;
    public            $uploadedLogo;
    public bool       $deleteLoading = false;
    public Collection $allAttributes;
    public array      $attr          = [];
    public Collection $allSites;
    public array      $sites         = [];


    public function rules()
    {

        return [
            'logo'                      => 'nullable|image|max:1024',
            'page.name.en'              => 'required',
            'page.name.ru'              => 'required',
            'page.short_description.en' => 'required',
            'page.short_description.ru' => 'required',
            'page.description.en'       => 'required',
            'page.description.ru'       => 'required',
            'page.slug'                 => 'required',
            'page.status'               => 'required|numeric',
            'attr.*'                    => 'sometimes',
            'sites.*'                   => 'sometimes',
        ];
    }

    public function boot()
    {
        $this->allSites      = Site::query()->get();
        $this->allAttributes = Attribute::query()->where('entity_type', Page::class)->get();

        if (!$this->page) {
            $this->page = new Page();
        }
    }

    /**
     * @throws \Throwable
     */
    public function render()
    {

        $page = Page::query()->with('attributes')->find($this->page->id);

        if ($page ?? null) {
            if ($page->attributes ?? null) {
                foreach ($page->attributes as $attr) {
                    $this->attr[$attr->attribute->slug] = !empty($attr->value) ? $attr->getTranslations('value') : $attr->getTranslations('text_value');
                }
            }

            $this->sites = $page->sites()->pluck('site_id')->toArray();
        }


        return view('livewire.pages.pages.edit');
    }

    public function submit(): bool
    {

        $this->validate();

        if ($this->logo ?? null) {
            $this->uploadedLogo = $this->logo->store('images/pages', 'public');
            $this->page->logo   = $this->uploadedLogo;
        }

        if (!empty($this->attr)) {
            $this->updateEntityAttributes($this->page, $this->attr);
        }

        $this->page->save();

        $this->page->sites()->sync($this->sites);


        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete()
    {
        $this->deleteLoading = true;

        if ($this->page->logo ?? null) {
            Storage::disk('public')->delete($this->page->logo);
        }

        $this->page->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('pages'));
    }
}
