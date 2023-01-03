<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PaymentSystemResource;
use App\Models\PaymentSystem;
use App\Services\SiteContainer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentSystemController
{
    public function index(?PaymentSystem $paymentSystem): AnonymousResourceCollection
    {

        $site = app(SiteContainer::class)->getSite();

        if ($paymentSystem->id ?? null) {
            $paymentSystems = $site->paymentSystems()->where(['payment_systems.id'=>$paymentSystem->id])->orderBy('sort')->get();
        } else {
            $paymentSystems = $site->paymentSystems()->orderBy('sort')->get();
        }

        return PaymentSystemResource::collection(
            $paymentSystems
        );
    }
}
