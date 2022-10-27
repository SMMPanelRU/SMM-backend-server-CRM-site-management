<?php

namespace App\Http\Livewire\Pages\Attributes;

use App\Models\Attribute;
use App\Models\Faq;
use App\Models\Site;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AttributeEdit extends Component
{

    public ?Attribute $attribute            = null;
    public bool       $deleteLoading        = false;
    public array      $attributeEntityTypes = [];

    public function rules()
    {

        return [
            'attribute.name.en'         => 'required',
            'attribute.name.ru'         => 'required',
            'attribute.type'            => 'required|numeric',
            'attribute.slug'            => 'required',
            'attribute.entity_type'     => 'required',
            'attribute.is_searchable'   => 'required|boolean',
            'attribute.is_translatable' => 'required|boolean',
        ];
    }

    public function boot()
    {

        $attributesEntityTypeValues = Attribute::query()->groupBy('entity_type')->pluck('entity_type');

        $entityTypeValues = [];

        foreach ($attributesEntityTypeValues as $item) {
            $entityTypeValues[$item] = __('entities.' . $item);
        }

        $this->attributeEntityTypes = $entityTypeValues;

        if (!$this->attribute) {
            $this->attribute = new Attribute();
        }
    }

    /**
     * @throws \Throwable
     */
    public function render()
    {
        return view('livewire.pages.attributes.edit');
    }

    public function submit(): bool
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


    public function delete()
    {
        $this->deleteLoading = true;

        $this->attribute->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('faqs'));
    }
}
