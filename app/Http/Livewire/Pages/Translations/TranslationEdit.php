<?php

namespace App\Http\Livewire\Pages\Translations;

use App\Enum\DefaultStatusEnum;
use App\Exceptions\Users\InsufficientFundsException;
use App\Models\Attribute;
use App\Models\ManualOrder;
use App\Models\Site;
use App\Models\Translation;
use App\Models\User;
use App\Services\UserService;
use App\Traits\EntityAttributeTrait;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Spatie\TranslationLoader\LanguageLine;

class TranslationEdit extends Component
{

    use EntityAttributeTrait;

    public ?Translation      $translation                     = null;


    public function rules()
    {

        return [
            'translation.group'   => 'required|string',
            'translation.key'     => 'required|string',
            'translation.text.en' => 'required|string',
            'translation.text.ru' => 'required|string',
        ];
    }

    public function boot()
    {
        if (!$this->translation) {
            $this->translation = new Translation();
        }
    }

    /**
     * @throws \Throwable
     */
    public function render()
    {

        return view('livewire.pages.translations.edit');
    }

    public function submit(): bool
    {

        $this->validate();

        $this->translation->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

}
