<?php

namespace App\Http\Livewire\Pages\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class ProductItem extends Component
{

    public Product $product;
    public bool    $deleteLoading = false;

    public Collection $allCategories;

    public function rules()
    {
        $categories = Category::class;

        return [
            'product.name.en'   => 'required',
            'product.name.ru'   => 'required',
            'product.slug'      => 'required',
            'product.sort'      => 'required|numeric',
            'product.price'     => 'required|numeric',
            'product.old_price' => 'sometimes|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.pages.products.item');
    }

    public function updated(): bool
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        $this->product->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete(Product $product)
    {
        $this->deleteLoading = true;

        $product->delete();

        $this->emitUp('refreshProducts');

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);
    }
}
