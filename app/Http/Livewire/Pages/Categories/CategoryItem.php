<?php

namespace App\Http\Livewire\Pages\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class CategoryItem extends Component
{

    use WithFileUploads;

    public Category $category;
    public          $logo;
    public          $uploadedLogo;
    public bool     $deleteLoading = false;

    public Collection $allCategories;

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
        ];
    }

    public function render()
    {
        return view('livewire.pages.categories.item');
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
            $this->uploadedLogo   = $this->logo->store('images/categories', 'public');
            $this->category->logo = $this->uploadedLogo;
        }

        if ($this->category->category_id === '') {
            $this->category->category_id = null;
        }

        if ($this->category->isDirty(['category_id'])) {
            $this->emitUp('refreshCategories');
        }

        $this->category->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete(Category $category)
    {
        $this->deleteLoading = true;

        if ($category->logo ?? null) {
            Storage::disk('public')->delete($category->logo);
        }

        $category->delete();

        $this->emitUp('refreshCategories');

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);
    }
}
