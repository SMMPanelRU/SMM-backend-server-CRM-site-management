<?php

namespace App\Actions\Order;

use App\Models\Product;
use App\Services\SiteContainer;
use Closure;
use Illuminate\Support\MessageBag;

class ValidateOrderAction
{
    public function handle($request, Closure $next)
    {
        $site = app(SiteContainer::class)->getSite();

        $errorBag = new MessageBag();

        foreach ($request['items'] as $key=>$requestItem) {
            $product = Product::query()->forSite($site)->with('attributes')->find($requestItem['id']);
            if ($product === null) {
                $errorBag->add('errors', "Item with id {$requestItem['id']} not found");
                unset($request['items'][$key]);
                continue;
            }

            if ($product->attributes ?? null) {
                foreach ($product->attributes as $attr) {
                    if ($attr->attribute->slug === 'min_count' && (int) $attr->non_translatable_value > (int) $requestItem['count']) {
                        $errorBag->add('errors', "Item with id {$requestItem['id']} min count - {$attr->non_translatable_value} {$requestItem['count']}");
                        unset($request['items'][$key]);
                    }
                    if ($attr->attribute->slug === 'max_count' && (int) $attr->non_translatable_value < (int) $requestItem['count']) {
                        $errorBag->add('errors', "Item with id {$requestItem['id']} max count - {$attr->non_translatable_value}");
                        unset($request['items'][$key]);
                    }
                }

            }
        }

        $request['errors'] = $errorBag;

        return $next($request);
    }
}
