<?php

namespace App\Http\Livewire\Pages\Tickets;

use App\Enum\Tickets\TicketStatusEnum;
use App\Http\Livewire\SortTrait;
use App\Models\Site;
use App\Models\Ticket;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;

class TicketTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshTickets' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $pages = Ticket::query()->search($this->search['filters']);
        } else {
            $pages = Ticket::query();
        }

        $rows = $this->sortItems($pages);

        $tableSettings = [
            'liveware_path' => 'pages.tickets.ticket-item',
            'item_key'      => 'ticket',
        ];

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('title', 'Title', 'text'),
            TableLayout::makeColumn('created_at', 'Created', 'date_range'),
            TableLayout::makeColumn('updated_at', 'Updated', 'date_range'),
            TableLayout::makeColumn('closed_at', 'Closed', 'date_range'),
            TableLayout::makeColumn('site_id', 'Site', 'select', Site::query()->pluck('name', 'id')),
            TableLayout::makeColumn('status', 'Status', 'select', TicketStatusEnum::asKeyValue()),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.tickets.table', ['rows' => $rows, 'tableSettings' => $tableSettings, 'columns' => $columns]);
    }
}
