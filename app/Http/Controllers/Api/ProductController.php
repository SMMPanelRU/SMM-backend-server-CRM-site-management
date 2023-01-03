<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Products\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\SiteContainer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController
{
    public function index(ProductRequest $request, ?Product $product): AnonymousResourceCollection
    {

        $site = app(SiteContainer::class)->getSite();

        if ($product->id ?? null) {
            $products = $site->products()->where(['products.id'=>$product->id])->orderBy('sort')->get();
        } else {
            $products = new Collection();
            if ($request->get('category_id') ?? null){
                $category = Category::findOrFail($request->get('category_id'));
                $tmpProducts = $category->products()->with('sites')->get();
                foreach ($tmpProducts as $tmpProduct) {
                    $sites = [];
                    foreach ($tmpProduct->sites as $s) {
                        $sites[] = $s->id;
                    }

                    if (in_array($site->id, $sites)) {
                        $products->add($tmpProduct);
                    }
                }

            } else {
                $products = $site->products()->orderBy('sort')->get();
            }
        }
        return ProductResource::collection(
            $products
        );
    }
}
