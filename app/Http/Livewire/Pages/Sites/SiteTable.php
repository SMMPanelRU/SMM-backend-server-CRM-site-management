<?php

namespace App\Http\Livewire\Pages\Sites;

use App\Enum\DefaultStatusEnum;
use App\Http\Livewire\SortTrait;
use App\Models\Site;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SiteTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshSites' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $site          = new Site();
        $site->name    = 'new';
        $site->status  = DefaultStatusEnum::OFF;
        $site->api_key = Hash::make(Str::random(10));
        $site->save();

        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => __('row was added')]);
    }

    public function render()
    {

        $sites = Site::query();

        if ($this->search['filters'] ?? null) {
            $sites->search($this->search['filters']);
        }

        $items = $this->sortItems($sites, $this->search);

        return view('livewire.pages.sites.table', ['sites' => $items]);
    }
}
