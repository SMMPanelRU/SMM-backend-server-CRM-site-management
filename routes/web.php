<?php

use App\Http\Livewire\Pages\Attributes\AttributeEdit;
use App\Http\Livewire\Pages\Attributes\AttributeTable;
use App\Http\Livewire\Pages\Categories\CategoryEdit;
use App\Http\Livewire\Pages\Categories\CategoryTable;
use App\Http\Livewire\Pages\ExportSystems\ExportSystemEdit;
use App\Http\Livewire\Pages\ExportSystems\ExportSystemTable;
use App\Http\Livewire\Pages\Faqs\FaqEdit;
use App\Http\Livewire\Pages\Faqs\FaqTable;
use App\Http\Livewire\Pages\Orders\OrderEdit;
use App\Http\Livewire\Pages\Orders\OrderTable;
use App\Http\Livewire\Pages\Pages\PageEdit;
use App\Http\Livewire\Pages\Pages\PageTable;
use App\Http\Livewire\Pages\Products\ProductEdit;
use App\Http\Livewire\Pages\Products\ProductTable;
use App\Http\Livewire\Pages\Sites\SiteTable;
use App\Http\Livewire\Pages\Tickets\TicketEdit;
use App\Http\Livewire\Pages\Tickets\TicketTable;
use App\Http\Livewire\Pages\Translations\TranslationEdit;
use App\Http\Livewire\Pages\Translations\TranslationTable;
use App\Http\Livewire\Pages\Users\UserEdit;
use App\Http\Livewire\Pages\Users\UserTable;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/install', function () {
    $isInit = false;
    if (!Schema::hasTable('users')) {
        Artisan::call('migrate --seed');
        $isInit = true;
    }

    if (!is_dir(base_path('public/storage'))) {
        Artisan::call('storage:link');
    }

    if (!file_exists(base_path('.env'))) {
        Artisan::call('key:generate');
    }

    if ($isInit) {
        return redirect('login');
    }

    abort(404);
})->withoutMiddleware(['web']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'administrator',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'sites'], function () {

        Route::get('', SiteTable::class)->name('sites');

    });

    Route::group(['prefix' => 'translations'], function () {

        Route::get('/edit/{translation?}', TranslationEdit::class)->name('translations.edit');

        Route::get('', TranslationTable::class)->name('translations');

    });

    Route::group(['prefix' => 'tickets'], function () {

        Route::get('/edit/{ticket?}', TicketEdit::class)->name('tickets.edit');

        Route::get('', TicketTable::class)->name('tickets');

    });


    Route::group(['prefix' => 'categories'], function () {

        Route::get('/edit/{category?}', CategoryEdit::class)->name('categories.edit');

        Route::get('{id?}', CategoryTable::class)->name('categories');

    });

    Route::group(['prefix' => 'export_systems'], function () {

        Route::get('/edit/{exportSystem?}', ExportSystemEdit::class)->name('export_systems.edit');

        Route::get('{exportSystem?}', ExportSystemTable::class)->name('export_systems');

    });

    Route::group(['prefix' => 'pages'], function () {

        Route::get('/edit/{page?}', PageEdit::class)->name('pages.edit');

        Route::get('', PageTable::class)->name('pages');

    });

    Route::group(['prefix' => 'faqs'], function () {

        Route::get('/edit/{faq?}', FaqEdit::class)->name('faqs.edit');

        Route::get('', FaqTable::class)->name('faqs');

    });

    Route::group(['prefix' => 'orders'], function () {

        Route::get('/orders/{order?}', OrderEdit::class)->name('orders.edit');

        Route::get('', OrderTable::class)->name('orders');

    });

    Route::group(['prefix' => 'users'], function () {

        Route::get('/users/{user?}', UserEdit::class)->name('users.edit');

        Route::get('', UserTable::class)->name('users');

    });


    Route::group(['prefix' => 'products'], function () {

        Route::get('/edit/{product?}', ProductEdit::class)->name('products.edit');

        Route::get('{category?}', ProductTable::class)->name('products');

    });

    Route::group(['prefix' => 'attributes'], function () {

        Route::get('/edit/{attribute?}', AttributeEdit::class)->name('attributes.edit');

        Route::get('', AttributeTable::class)->name('attributes');

    });
});


/* Fortify routes */
Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    $enableViews = config('fortify.views', true);

    $limiter             = config('fortify.limiters.login');
    $twoFactorLimiter    = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
         ->middleware(array_filter([
             'guest:' . config('fortify.guard'),
             $limiter ? 'throttle:' . $limiter : null,
         ]))
         ->name('login');

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
         ->name('logout');

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        if ($enableViews) {
            Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                 ->middleware(['guest:' . config('fortify.guard')])
                 ->name('password.request');

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                 ->middleware(['guest:' . config('fortify.guard')])
                 ->name('password.reset');
        }

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
             ->middleware(['guest:' . config('fortify.guard')])
             ->name('password.email');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
             ->middleware(['guest:' . config('fortify.guard')])
             ->name('password.update');
    }

    // Registration...
    if (Features::enabled(Features::registration())) {
        if ($enableViews) {
            Route::get('/register', [RegisteredUserController::class, 'create'])
                 ->middleware(['guest:' . config('fortify.guard')])
                 ->name('register');
        }

        Route::post('/register', [RegisteredUserController::class, 'store'])
             ->middleware(['guest:' . config('fortify.guard')]);
    }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        if ($enableViews) {
            Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
                 ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                 ->name('verification.notice');
        }

        Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
             ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'signed', 'throttle:' . $verificationLimiter])
             ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
             ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'throttle:' . $verificationLimiter])
             ->name('verification.send');
    }

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
             ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
             ->name('user-profile-information.update');
    }

    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put('/user/password', [PasswordController::class, 'update'])
             ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
             ->name('user-password.update');
    }

    // Password Confirmation...
    if ($enableViews) {
        Route::get('/user/confirm-password', [ConfirmablePasswordController::class, 'show'])
             ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')]);
    }

    Route::get('/user/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])
         ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
         ->name('password.confirmation');

    Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store'])
         ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
         ->name('password.confirm');

    // Two Factor Authentication...
    if (Features::enabled(Features::twoFactorAuthentication())) {
        if ($enableViews) {
            Route::get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])
                 ->middleware(['guest:' . config('fortify.guard')])
                 ->name('two-factor.login');
        }

        Route::post('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store'])
             ->middleware(array_filter([
                 'guest:' . config('fortify.guard'),
                 $twoFactorLimiter ? 'throttle:' . $twoFactorLimiter : null,
             ]));

        $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
            ? [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'password.confirm']
            : [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')];

        Route::post('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])
             ->middleware($twoFactorMiddleware)
             ->name('two-factor.enable');

        Route::post('/user/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthenticationController::class, 'store'])
             ->middleware($twoFactorMiddleware)
             ->name('two-factor.confirm');

        Route::delete('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
             ->middleware($twoFactorMiddleware)
             ->name('two-factor.disable');

        Route::get('/user/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
             ->middleware($twoFactorMiddleware)
             ->name('two-factor.qr-code');

        Route::get('/user/two-factor-secret-key', [TwoFactorSecretKeyController::class, 'show'])
             ->middleware($twoFactorMiddleware)
             ->name('two-factor.secret-key');

        Route::get('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
             ->middleware($twoFactorMiddleware)
             ->name('two-factor.recovery-codes');

        Route::post('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
             ->middleware($twoFactorMiddleware);
    }
});


Route::get('/{login?}', function () {
    return view('pages.auth.login');
})->name('welcome')->withoutMiddleware(\App\Http\Middleware\IsAdministrator::class);
