<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\SiteContainer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController
{
    public function index(Request $request, ?Product $product): AnonymousResourceCollection
    {

        $site = app(SiteContainer::class)->getSite();

        if ($product->id ?? null) {
            $products = $site->products()->where(['products.id'=>$product->id])->orderBy('sort')->get();
        } else {
            $products = $site->products()->orderBy('sort')->get();
        }
        return ProductResource::collection(
            $products
        );
    }
}
