<?php

namespace App\Http\Livewire\Pages\Attributes;

use App\Enum\DefaultStatusEnum;
use App\Models\Attribute;
use App\Models\Site;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class AttributeItem extends Component
{

    use WithFileUploads;

    public Attribute $attribute;
    public bool $deleteLoading = false;

    public function rules()
    {
        return [
            'attribute.name'   => 'required',
            'attribute.slug'    => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.pages.attributes.item');
    }

    public function updated(): bool
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        $this->attribute->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }

    public function delete(Attribute $attribute)
    {
        $this->deleteLoading = true;

        $attribute->delete();

        $this->emitUp('refreshAttributes');

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);
    }
}
