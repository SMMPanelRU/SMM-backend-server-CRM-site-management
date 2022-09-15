<?php

namespace Tests\Feature\Livewire\Pages;

use App\Http\Livewire\Pages\Sites\SiteItem;
use App\Http\Livewire\Pages\Sites\SiteTable;
use App\Models\Site;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SitesTest extends TestCase
{

    public function test_site_the_component_can_render()
    {
        $component = Livewire::test(SiteTable::class);

        $component->assertStatus(200);
    }

    function test_site_create()
    {
        Livewire::test(SiteTable::class)
                ->call('create');

        $this->assertTrue(Site::query()->where('name', 'new')->exists());
    }


    public function test_site_search_by_id()
    {

        $site = Site::factory([
            'name' => 'test_for_search',
        ])->make();

        /* @var \App\Models\Site $site */

        $component = Livewire::test(SiteTable::class, ['search' => ['id' => $site->id]]);

        $component->assertSee('name', 'test_for_search');
    }

    public function test_site_search_by_name()
    {

        $name = 'test_for_search';

        Site::factory([
            'name' => $name,
        ])->make();

        /* @var \App\Models\Site $site */

        $component = Livewire::test(SiteTable::class, ['search' => ['name' => $name]]);

        $component->assertSee('name', $name);
    }

    public function test_site_update()
    {

        $name = 'test_for_search';

        $site = Site::factory([
            'name' => $name,
        ])->make();

        /* @var \App\Models\Site $site */

        $component = Livewire::test(SiteItem::class, ['site' => $site])
                             ->set('site.name', "{$name}2");

        $component->assertSet('site.name', "{$name}2");
    }

    public function test_site_delete()
    {

        $name = 'test_for_search';

        $site = Site::factory([
            'name' => $name,
        ])->make();

        /* @var \App\Models\Site $site */

        $component = Livewire::test(SiteItem::class, ['site' => $site])
                             ->call('delete');

        $component->assertStatus(200);
    }
}
