<?php

namespace App\Http\Livewire\Pages\Sites;

use App\Enum\DefaultStatusEnum;
use App\Models\Site;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class SiteItem extends Component
{

    use WithFileUploads;

    public Site $site;
    public      $logo;
    public      $uploadedLogo;
    public bool $deleteLoading = false;
    public      $apiKey        = null;

    public function rules()
    {
        return [
            'logo'        => 'nullable|image|max:1024',
            'site.name'   => 'required',
            'site.url'    => 'required|url',
            'site.status' => [
                'required',
                new Enum(DefaultStatusEnum::class),
            ],
        ];
    }

    public function render()
    {
        return view('livewire.pages.sites.item');
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
            $this->uploadedLogo = $this->logo->store('images/sites', 'public');
            $this->site->logo   = $this->uploadedLogo;
        }

        $this->site->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

    public function showApiKey()
    {
        $this->apiKey = $this->site->api_key;
    }

    public function hideApiKey()
    {
        $this->apiKey = null;
    }

    public function delete(Site $site)
    {
        $this->deleteLoading = true;

        if ($site->logo ?? null) {
            Storage::disk('public')->delete($site->logo);
        }

        $site->delete();

        $this->emitUp('refreshSites');

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);
    }
}
