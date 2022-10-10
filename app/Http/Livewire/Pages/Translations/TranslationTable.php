<?php

namespace App\Http\Livewire\Pages\Translations;

use App\Enum\DefaultStatusEnum;
use App\Http\Livewire\SortTrait;
use App\Models\Site;
use App\Models\Translation;
use App\Models\User;
use App\View\Components\TableLayout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\TranslationLoader\LanguageLine;

class TranslationTable extends Component
{

    use WithPagination, SortTrait;

    public array $search = [];

    protected $queryString = ['search'];

    public $listeners = ['refreshTranslations' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (!empty(collect($this->search['filters'] ?? [])->filter()->toArray())) {
            $pages = Translation::query()->search($this->search['filters']);
        } else {
            $pages = Translation::query();
        }

        $rows = $this->sortItems($pages);

        $tableSettings = [
            'liveware_path' => 'pages.translations.translation-item',
            'item_key'      => 'translation',
            'create_route'     => route('translations.edit'),
        ];

        $columns = [
            TableLayout::makeColumn('id', 'ID', 'text', null, false, 'wd-10p'),
            TableLayout::makeColumn('group', 'Group', 'text'),
            TableLayout::makeColumn('key', 'Key', 'text'),
            TableLayout::makeColumn('text_en', 'En', 'text'),
            TableLayout::makeColumn('text_ru', 'Ru', 'text'),
            TableLayout::makeColumn('', ''),
        ];

        return view('livewire.pages.translations.table', ['rows' => $rows, 'tableSettings' => $tableSettings, 'columns' => $columns]);
    }
}
