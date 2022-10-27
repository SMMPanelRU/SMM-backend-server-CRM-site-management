<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\SiteContainer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController
{
    public function index(Request $request, ?Category $category): AnonymousResourceCollection
    {

        $site = app(SiteContainer::class)->getSite();

        return CategoryResource::collection(
            Category::query()->orderBy('sort')->get()
        );
    }
}
