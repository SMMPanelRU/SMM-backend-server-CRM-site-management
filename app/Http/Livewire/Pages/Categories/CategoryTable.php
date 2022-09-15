<?php

namespace App\Http\Livewire\Pages\Categories;

use App\Http\Livewire\SortTrait;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshCategories' => '$refresh'];

    public Collection $allCategories;

    public ?Category $parent = null;

    public function boot()
    {
        $this->allCategories = Category::query()->whereNull('category_id')->get();
    }

    public function mount($id = null)
    {
        if ($id ?? null) {
            $this->parent = Category::query()->findOrFail($id);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $categories = Category::query()->search($this->search['filters'])->with('childCategories');
        } elseif ($this->parent ?? null) {
            $categories = Category::query()->with('childCategories')->where('category_id', $this->parent->id);
        } else {
            $categories = Category::query()->with('childCategories')->whereNull('category_id');
        }

        $items = $this->sortItems($categories, array_merge(['orderBy'=>'sort', 'orderDir'=>'asc'], $this->search));

        return view('livewire.pages.categories.table', ['categories' => $items, 'parent' => $this->parent]);
    }
}
