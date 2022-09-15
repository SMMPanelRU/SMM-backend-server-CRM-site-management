<?php

namespace App\Http\Livewire\Pages\Categories;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\EntityAttribute;
use App\Traits\EntityAttributeTrait;
use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use function PHPUnit\Framework\isNull;

class CategoryEdit extends Component
{

    use WithFileUploads, EntityAttributeTrait;

    public ?Category $category      = null;
    public           $logo;
    public           $uploadedLogo;
    public bool      $deleteLoading = false;

    public            $allCategories;
    public Collection $allAttributes;
    public array      $attr = [];

    public function rules()
    {
        $categories = Category::class;

        return [
            'logo'                 => 'nullable|image|max:1024',
            'category.name.en'     => 'required',
            'category.name.ru'     => 'required',
            'category.slug'        => 'required',
            'category.sort'        => 'required|numeric',
            'category.category_id' => "nullable|exists:$categories,id",
            'attr.*'               => 'array',
        ];
    }

    public function boot()
    {
        $this->allCategories = Category::query()->pluck('name', 'id');
        $this->allAttributes = Attribute::query()->where('entity_type', Category::class)->get();


        if (!$this->category) {
            $this->category = new Category();
        }
    }

    public function mount($category = null)
    {

    }

    public function render()
    {

        if ($this->category ?? null) {
            $category = Category::query()->with('attributes')->find($this->category->id);

            if ($category->attributes ?? null) {
                foreach ($category->attributes as $attr) {
                    $this->attr[$attr->attribute->slug] = !empty($attr->value) ? $attr->getTranslations('value') : $attr->getTranslations('text_value');
                }
            }
        }

        return view('livewire.pages.categories.edit');
    }

    public function submit(): bool
    {

        $this->validate();

        if ($this->category->category_id === '') {
            $this->category->category_id = null;
        }

        if ($this->logo ?? null) {
            $this->uploadedLogo   = $this->logo->store('images/categories', 'public');
            $this->category->logo = $this->uploadedLogo;
        }

        if (!empty($this->attr)) {
            $this->updateEntityAttributes($this->category, $this->attr);
        }

        $this->category->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete()
    {
        $this->category->attributes()->delete();

        $this->deleteLoading = true;

        if ($this->category->logo ?? null) {
            Storage::disk('public')->delete($this->category->logo);
        }

        $this->category->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('categories'));
    }
}
