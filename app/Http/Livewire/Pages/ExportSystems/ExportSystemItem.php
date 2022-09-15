<?php

namespace App\Http\Livewire\Pages\ExportSystems;


use App\Models\ExportSystem;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class ExportSystemItem extends Component
{

    use WithFileUploads;

    public ExportSystem $exportSystem;
    public              $logo;
    public              $uploadedLogo;
    public bool         $deleteLoading = false;

    public function rules()
    {

        return [
            'logo'                 => 'nullable|image|max:1024',
            'exportSystem.name.en' => 'required',
            'exportSystem.name.ru' => 'required',
            'exportSystem.slug'    => 'required',
            'exportSystem.status'  => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.pages.export_systems.item');
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
            $this->uploadedLogo    = $this->logo->store('images/export_systems', 'public');
            $this->exportSystem->logo = $this->uploadedLogo;
        }

        $this->exportSystem->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete(ExportSystem $exportSystem)
    {
        $this->deleteLoading = true;

        if ($exportSystem->logo ?? null) {
            Storage::disk('public')->delete($exportSystem->logo);
        }

        $exportSystem->delete();

        $this->emitUp('refreshExportSystems');

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);
    }
}
