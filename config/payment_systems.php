<?php

use App\Services\PaymentSystems\BalancePaymentSystem;
use App\Services\PaymentSystems\TegroMoneyPaymentSystem;

return [
    'TegroMoney' => TegroMoneyPaymentSystem::class,
    'Balance' => BalancePaymentSystem::class,
];
