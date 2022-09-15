<?php

namespace App\Http\Livewire\Pages\Pages;

use App\Http\Livewire\SortTrait;
use App\Models\Page;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;

class PageTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshPages' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $pages = Page::query()->search($this->search['filters']);
        } else {
            $pages = Page::query();
        }

        $rows = $this->sortItems($pages);

        $tableSettings = [
            'liveware_path' => 'pages.pages.page-item',
            'item_key'      => 'page',
            'create_route'     => route('pages.edit'),
        ];

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('logo'),
            TableLayout::makeColumn('name', 'Name', 'text'),
            TableLayout::makeColumn('slug', 'Code', 'text'),
            TableLayout::makeColumn('status', 'Status', 'text'),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.pages.table', ['rows' => $rows, 'tableSettings' => $tableSettings, 'columns' => $columns]);
    }
}
