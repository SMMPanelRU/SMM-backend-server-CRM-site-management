<?php

namespace App\Http\Livewire\Pages\Products;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\DiscountProduct;
use App\Models\ExportSystem;
use App\Models\ExportSystemProduct;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Site;
use App\Traits\EntityAttributeTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component {

    use WithFileUploads, EntityAttributeTrait;

    public ?Product $product = null;
    public bool $deleteLoading = false;

    public Collection $allCategories;
    public Collection $allAttributes;
    public Collection $allSites;
    public array $attr = [];
    public array $cats = [];
    public array $sites = [];
    public ?int $exportSystem = null;
    public Collection $allExportSystems;
    public ?Collection $exportSystemProducts = null;
    public array $prices = [];
    public array $discounts = [];

    public function rules() {

        return [
            'product.name.en' => 'required',
            'product.name.ru' => 'required',

            'product.short_description.en' => 'required',
            'product.short_description.ru' => 'required',

            'product.description.en' => 'required',
            'product.description.ru' => 'required',

            'product.slug'                     => 'required',
            'product.multiplicity'             => 'required|numeric',
            'product.sort'                     => 'required|numeric',
            'product.export_system_product_id' => 'sometimes|numeric',

            'cats.*'      => "sometimes",
            'attr.*'      => 'sometimes',
            'sites.*'     => 'sometimes',
            'prices.*'    => 'sometimes',
            'discounts.*' => 'sometimes',
        ];
    }

    public function boot() {
        $this->allCategories = Category::query()->get();
        $this->allSites = Site::query()->get();
        $this->allAttributes = Attribute::query()->where('entity_type', Product::class)->get();
        $this->allExportSystems = ExportSystem::query()->active()->get();

        if (!$this->product) {
            $this->product = new Product();
        }
    }

    public function render() {

        if ($this->product->id ?? null) {
            $product = Product::query()->with(['attributes', 'exportSystemProduct'])->find($this->product->id);

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

            if ($product->export_system_product_id ?? null) {
                $this->exportSystem = $product->exportSystem->id;
                $this->exportSystemProducts = $product->exportSystem->exportSystemProducts()->active()->get();
            }

            foreach ($this->allSites as $site) {
                $productPrice = $this->product->price($site->id)->first();
                if ($productPrice ?? null) {
                    $this->prices[$site->id] = $productPrice;
                }
            }

            $this->discounts['existed'] = $this->product->discounts()->get()->keyBy('id')->toArray();

            if (empty($this->discounts['new'])) {
                $this->discounts['new'] = [];
            }
        }

        return view('livewire.pages.products.edit');
    }

    public function addEmptyDiscount() {
        $this->discounts['new'][] = [
            'count'    => 0,
            'discount' => 0,
        ];
    }

    public function updatedExportSystem($value): bool {

        if ((int)$value === 0) {
            $this->exportSystem = null;
            $this->exportSystemProducts = null;

            return false;
        }

        $exportSystem = ExportSystem::find($value);
        if ($exportSystem === null) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => __('errors.Export system not found')]);

            return false;
        }

        $this->exportSystemProducts = ExportSystemProduct::query()->active()->where('export_system_id', $exportSystem->id)->get();

        return true;
    }

    public function submit(): bool {

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => $e->getMessage()]);

            return false;
        }

        $this->product->save();

        if (!empty($this->prices)) {
            foreach ($this->prices as $siteId => $price) {
                if (empty($price['price'])) {
                    continue;
                }

                if (empty($price['old_price'])) {
                    $price['old_price'] = null;
                }

                ProductPrice::updateOrCreate(
                    ['product_id' => $this->product->id, 'site_id' => $siteId],
                    ['price' => $price['price'], 'old_price' => $price['old_price']]
                );
            }
        }


        foreach ($this->discounts['existed'] as $discount) {
            $discountProduct = DiscountProduct::find($discount['id']);
            if ($discountProduct ?? null) {
                if ($discount['count'] > 0) {
                    $discountProduct->count = $discount['count'];
                    $discountProduct->discount = $discount['discount'];
                    $discountProduct->save();
                } else {
                    $discountProduct->delete();
                }
            }
        }

        foreach ($this->discounts['new'] as $discount) {
            if ($discount['count'] > 0) {
                $discountProduct = new DiscountProduct();
                $discountProduct->product()->associate($this->product);
                $discountProduct->count = $discount['count'];
                $discountProduct->discount = $discount['discount'];
                $discountProduct->save();
            }
        }

        $this->discounts['new'] = [];

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


    public function delete() {
        $this->product->attributes()->delete();

        $this->deleteLoading = true;

        $this->product->delete();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was deleted')]);

        redirect(route('products'));
    }
}
