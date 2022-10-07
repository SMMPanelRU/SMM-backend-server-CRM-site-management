<?php

namespace App\Http\Livewire\Pages\Orders;

use App\Http\Livewire\SortTrait;
use App\Models\Order;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshOrders' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $orders = Order::query()->search($this->search['filters']);
        } else {
            $orders = Order::query();
        }

        $orders->with(['products']);

        $rows = $this->sortItems($orders);

        $tableSettings = [
            'liveware_path' => 'pages.orders.order-item',
            'item_key'      => 'order',
        ];

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('user', 'User', 'text'),
            TableLayout::makeColumn('product', 'Product', 'text'),
            TableLayout::makeColumn('count', 'Count'),
            TableLayout::makeColumn('amount', 'Amount'),
            TableLayout::makeColumn('discount', 'Discount'),
            TableLayout::makeColumn('payment_system', 'Payment system'),
            TableLayout::makeColumn('status', 'Status', 'text'),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.orders.table', ['rows' => $rows, 'tableSettings' => $tableSettings, 'columns' => $columns]);
    }
}
