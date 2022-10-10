<?php

namespace App\Http\Livewire\Pages\Users;

use App\Enum\DefaultStatusEnum;
use App\Http\Livewire\SortTrait;
use App\Models\Site;
use App\Models\User;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshUsers' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $pages = User::query()->search($this->search['filters']);
        } else {
            $pages = User::query();
        }

        $rows = $this->sortItems($pages);

        $tableSettings = [
            'liveware_path' => 'pages.users.user-item',
            'item_key'      => 'user',
        ];

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('name', 'Name', 'text'),
            TableLayout::makeColumn('email', 'Email', 'text'),
            TableLayout::makeColumn('balance', 'Balance'),
            TableLayout::makeColumn('site_id', 'Site', 'select', Site::query()->pluck('name', 'id')),
            TableLayout::makeColumn('status', 'Status', 'select', DefaultStatusEnum::asKeyValue()),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.users.table', ['rows' => $rows, 'tableSettings' => $tableSettings, 'columns' => $columns]);
    }
}
