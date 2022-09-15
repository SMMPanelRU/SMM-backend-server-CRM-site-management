<?php

namespace App\Http\Livewire\Pages\Faqs;

use App\Http\Livewire\SortTrait;
use App\Models\Faq;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;

class FaqTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshFaqs' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $faqs = Faq::query()->search($this->search['filters']);
        } else {
            $faqs = Faq::query();
        }

        $rows = $this->sortItems($faqs);

        $tableSettings = [
            'liveware_path' => 'pages.faqs.faq-item',
            'item_key'      => 'faq',
            'create_route'     => route('faqs.edit'),
        ];

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('question'),
            TableLayout::makeColumn('status', 'Status', 'text'),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.faqs.table', ['rows' => $rows, 'tableSettings' => $tableSettings, 'columns' => $columns]);
    }
}
