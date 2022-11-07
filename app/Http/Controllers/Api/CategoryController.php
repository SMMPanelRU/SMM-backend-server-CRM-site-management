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

        $categories = Category::query()->orderBy('sort')->get();

        $categoriesFound = [];

        foreach ($categories as $category) {
            if ($category->category_id ?? null) {
                $products = $category->products()->with('sites')->get();

                foreach ($products as $product) {
                    $sites = [];
                    foreach ($product->sites as $s) {
                        $sites[] = $s->id;
                    }

                    if (in_array($site->id, $sites)) {
                        if ($category->category_id ?? null) {
                            $categoriesFound[$category->category_id] = $category->category_id;
                        }
                        $categoriesFound[$category->id] = $category->id;
                    }
                }
            }
        }

        return CategoryResource::collection(
            Category::query()->whereIn('id', $categoriesFound)->orderBy('sort')->get()
        );
    }
}
