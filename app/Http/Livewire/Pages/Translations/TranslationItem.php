<?php

namespace App\Http\Livewire\Pages\Translations;

use App\Enum\DefaultStatusEnum;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\TranslationLoader\LanguageLine;

class TranslationItem extends Component
{

    public Translation $translation;
    public bool        $deleteLoading = false;

    public function rules()
    {
        return [
            'translation.group'   => 'required|string',
            'translation.key'     => 'required|string',
            'translation.text.en' => 'required|string',
            'translation.text.ru' => 'required|string',
        ];
    }

    public function render()
    {
        return view('livewire.pages.translations.item');
    }

    public function updated(): bool
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        $this->translation->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

}
