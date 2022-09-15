<?php

namespace App\Http\Livewire\Pages\Attributes;

use App\Http\Livewire\SortTrait;
use App\Models\Attribute;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;

class AttributeTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshAttributes' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $attributes = Attribute::query();

        if ($this->search['filters'] ?? null) {
            $attributes->search($this->search['filters']);
        }

        $rows = $this->sortItems($attributes);

        $tableSettings = [
            'liveware_path' => 'pages.attributes.attribute-item',
            'item_key'      => 'attribute',
            'create_route'     => route('attributes.edit'),
        ];

        $attributesEntityTypeValues = Attribute::query()->groupBy('entity_type')->pluck('entity_type');

        $entityTypeValues = [];

        foreach ($attributesEntityTypeValues as $item)
        {
            $entityTypeValues[$item] = __('entities.'.$item);
        }

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('name', 'Name', 'text'),
            TableLayout::makeColumn('type', 'Input type'),
            TableLayout::makeColumn('slug', 'Slug', 'text'),
            TableLayout::makeColumn('entity_type', 'Type', 'select', $entityTypeValues),
            TableLayout::makeColumn('created_at', 'Created'),
            TableLayout::makeColumn('updated_at', 'Updated'),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.faqs.table', ['rows' => $rows, 'tableSettings' => $tableSettings, 'columns' => $columns]);

    }
}
