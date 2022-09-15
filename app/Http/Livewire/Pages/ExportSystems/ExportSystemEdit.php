<?php

namespace App\Http\Livewire\Pages\ExportSystems;

use App\Models\ExportSystem;
use App\Services\ExportSystems\BaseExportSystem;
use App\Traits\EntityAttributeTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Throwable;

class ExportSystemEdit extends Component
{

    use WithFileUploads, EntityAttributeTrait;

    public ?ExportSystem $exportSystem  = null;
    public               $logo;
    public               $uploadedLogo;
    public bool          $deleteLoading = false;
    public array         $settings;
    public mixed         $balance;

    public function rules()
    {

        return [
            'logo'                 => 'nullable|image|max:1024',
            'exportSystem.name.en' => 'required',
            'exportSystem.name.ru' => 'required',
            'exportSystem.slug'    => 'required',
            'exportSystem.status'  => 'required|numeric',
            'exportSystem.handler' => 'sometimes',
            'settings'             => 'array',
        ];
    }

    public function boot()
    {
        if (!$this->exportSystem) {
            $this->exportSystem = new ExportSystem();
        }
    }

    /**
     * @throws \Throwable
     */
    public function render()
    {
        $baseExportSystem = new BaseExportSystem();
        $currentHandler   = null;

        if ($this->exportSystem->handler ?? null) {
            $currentHandler = $baseExportSystem->getInstance($this->exportSystem->handler);
            try {
                $this->balance = $currentHandler->getBalance();
            } catch (Throwable $e) {
                $this->balance = $e->getMessage();
            }
        }

        $this->settings = $this->exportSystem->settings ?? [];

        return view('livewire.pages.export_systems.edit', ['baseExportSystem' => $baseExportSystem, 'currentHandler' => $currentHandler]);
    }

    public function submit(): bool
    {

        $this->validate();

        if ($this->logo ?? null) {
            $this->uploadedLogo       = $this->logo->store('images/export_systems', 'public');
            $this->exportSystem->logo = $this->uploadedLogo;
        }

        if ($this->exportSystem->handler === '') {
            $this->exportSystem->handler = null;
        }

        if ($this->exportSystem->handler ?? null) {
            $baseExportSystem = new BaseExportSystem();
            $currentHandler = $baseExportSystem->getInstance($this->exportSystem->handler);
            foreach ($currentHandler->params as $paramKey=>$paramValue) {
                foreach ($this->settings as $settingKey=>$settingValue) {
                    if ($settingKey === $paramKey && ($paramValue['secret'] ?? null) === true) {
                        $this->settings[$settingKey] = encrypt($settingValue);
                    }
                }
            }
        }

        $this->exportSystem->settings = $this->settings;

        $this->exportSystem->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete()
    {
        $this->deleteLoading = true;

        if ($this->exportSystem->logo ?? null) {
            Storage::disk('public')->delete($this->exportSystem->logo);
        }

        $this->exportSystem->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('export_systems'));
    }
}
