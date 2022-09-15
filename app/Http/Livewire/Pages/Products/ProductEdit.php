<?php

namespace App\Http\Livewire\Pages\Products;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\Site;
use App\Traits\EntityAttributeTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{

    use WithFileUploads, EntityAttributeTrait;

    public ?Product $product       = null;
    public bool     $deleteLoading = false;

    public Collection $allCategories;
    public Collection $allAttributes;
    public Collection $allSites;
    public array      $attr  = [];
    public array      $cats  = [];
    public array      $sites = [];

    public function rules()
    {

        return [
            'product.name.en' => 'required',
            'product.name.ru' => 'required',

            'product.short_description.en' => 'required',
            'product.short_description.ru' => 'required',

            'product.description.en' => 'required',
            'product.description.ru' => 'required',

            'product.slug'      => 'required',
            'product.sort'      => 'required|numeric',
            'product.price'     => 'required|numeric',
            'product.old_price' => 'sometimes|numeric',

            'cats.*'  => "sometimes",
            'attr.*'  => 'sometimes',
            'sites.*' => 'sometimes',
        ];
    }

    public function boot()
    {
        $this->allCategories = Category::query()->get();
        $this->allSites      = Site::query()->get();
        $this->allAttributes = Attribute::query()->where('entity_type', Product::class)->get();

        if (!$this->product) {
            $this->product = new Product();
        }
    }

    public function mount($product = null)
    {

    }

    public function render()
    {

        if ($this->product->id ?? null) {
            $product = Product::query()->with('attributes')->find($this->product->id);

            if ($product->attributes ?? null) {
                foreach ($product->attributes as $attr) {
                    if (in_array($attr->attribute->type, [AttributeTypesEnum::Select])) {
                        $this->attr[$attr->attribute->slug] = $attr->attribute_predefined_value_id;
                    } else {
                        if ($attr->attribute->is_translatable) {
                            $this->attr[$attr->attribute->slug] = !empty($attr->value) ? $attr->getTranslations('value') : $attr->getTranslations('text_value');
                        } else {
                            $this->attr[$attr->attribute->slug] = $attr->non_translatable_value;
                        }
                    }
                }
            }

            $this->cats = $product->categories->pluck('id')->toArray();

            $this->sites = $product->sites()->pluck('site_id')->toArray();
        }

        return view('livewire.pages.products.edit');
    }

    public function submit(): bool
    {

        $this->validate();

        $this->product->save();

        if (!empty($this->attr)) {
            $this->updateEntityAttributes($this->product, $this->attr);
        }

        if (!empty($this->cats)) {
            $this->product->categories()->sync($this->cats);
        }

        $this->product->sites()->sync($this->sites);


        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was updated')]);

        return true;
    }


    public function delete()
    {
        $this->product->attributes()->delete();

        $this->deleteLoading = true;

        $this->product->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('products'));
    }
}
