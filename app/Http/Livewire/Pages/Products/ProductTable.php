<?php

namespace App\Http\Livewire\Pages\Products;

use App\Http\Livewire\SortTrait;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshProducts' => '$refresh'];

    public Collection $allCategories;

    public ?Category $category = null;

    public Collection $categoryTree;

    public function boot()
    {
        $this->allCategories = Category::query()->whereNull('category_id')->get();
    }

    public function mount($category = null)
    {
        if ($category ?? null) {
            $this->category = Category::query()->findOrFail($category->id);

            $categoryTree = new Collection();
            $this->categoryTree($this->category, $categoryTree);
            $this->categoryTree = $categoryTree->reverse();
            \Debugbar::info($this->categoryTree);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if ($this->category ?? null) {
            $categories = Category::query()->with('childCategories')->where('category_id', $this->category->id);
        } else {
            $categories = Category::query()->with('childCategories')->whereNull('category_id');
        }

        $categoryItems = $this->sortItems($categories, array_merge(['orderBy' => 'sort', 'orderDir' => 'asc'], $this->search));

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $products = Product::query()->search($this->search['filters']);
        } elseif ($this->category ?? null) {
            $products = $this->category->products();
        } else {
            $products = null;
        }

        if ($products ?? null) {
            $productItems = $this->sortItems($products, array_merge(['orderBy' => 'sort', 'orderDir' => 'asc'], $this->search));
        } else {
            $productItems = null;
        }

        return view('livewire.pages.products.table', ['categories' => $categoryItems, 'products' => $productItems]);
    }

    private function categoryTree(Category $category, Collection &$collection): Collection
    {

        if ($collection->isEmpty()) {
            $collection->add($category);
        }

        if ($category->category_id === null)
        {
            return $collection;
        }

        $parent = Category::find($category->category_id);
        $collection->add($parent);

        return $this->categoryTree($parent, $collection);

    }
}
