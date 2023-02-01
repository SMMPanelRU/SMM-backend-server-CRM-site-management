<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Services\SiteContainer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PageController
{
    public function index(?Page $page): AnonymousResourceCollection
    {

        $site = app(SiteContainer::class)->getSite();

        if ($page->id ?? null) {
            $pages = $site->pages()->where(['pages.id'=>$page->id])->get();

            if (!$pages) {
                abort(404);
            }
        } else {
            $pages = $site->pages()->get();
        }

        return PageResource::collection(
            $pages
        );
    }
}
