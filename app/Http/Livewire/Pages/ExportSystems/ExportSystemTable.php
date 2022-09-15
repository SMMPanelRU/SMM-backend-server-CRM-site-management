<?php

namespace App\Http\Livewire\Pages\ExportSystems;

use App\Http\Livewire\SortTrait;
use App\Models\ExportSystem;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;

class ExportSystemTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshExportSystems' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $exportSystems = ExportSystem::query()->search($this->search['filters']);
        } else {
            $exportSystems = ExportSystem::query();
        }

        $rows = $this->sortItems($exportSystems);


        $tableSettings = [
            'liveware_path'=>'pages.export-systems.export-system-item',
            'item_key'=>'exportSystem',
        ];

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('logo'),
            TableLayout::makeColumn('name', 'Name', 'text'),
            TableLayout::makeColumn('slug', 'Code', 'text'),
            TableLayout::makeColumn('handler', 'Handler', 'text'),
            TableLayout::makeColumn('status', 'Status', 'text'),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.export_systems.table', ['rows' => $rows, 'tableSettings'=>$tableSettings, 'columns'=>$columns]);
    }
}
