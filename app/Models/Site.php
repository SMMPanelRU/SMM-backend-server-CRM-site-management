<?php

namespace App\Models;

use App\Enum\DefaultStatusEnum;
use App\Models\Traits\SearchTrait;
use Database\Factories\SiteFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Site
 *
 * @property int                                                                       $id
 * @property \Illuminate\Support\Carbon|null                                           $created_at
 * @property \Illuminate\Support\Carbon|null                                           $updated_at
 * @property string                                                                    $name
 * @property string|null                                                               $logo
 * @property DefaultStatusEnum                                                         $status
 * @property string                                                                    $api_key
 * @property string|null                                                               $url
 * @property int|null                                                                  $currency_id
 * @property string                                                                    $lang
 * @property-read \App\Models\Currency|null                                            $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faq[]           $faqs
 * @property-read int|null                                                             $faqs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[]          $pages
 * @property-read int|null                                                             $pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentSystem[] $paymentSystems
 * @property-read int|null                                                             $payment_systems_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[]       $products
 * @property-read int|null                                                             $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[]          $users
 * @property-read int|null                                                             $users_count
 * @method static \Database\Factories\SiteFactory factory(...$parameters)
 * @method static Builder|Site newModelQuery()
 * @method static Builder|Site newQuery()
 * @method static Builder|Site query()
 * @method static Builder|Site search($data = [])
 * @method static Builder|Site whereApiKey($value)
 * @method static Builder|Site whereCreatedAt($value)
 * @method static Builder|Site whereCurrencyId($value)
 * @method static Builder|Site whereId($value)
 * @method static Builder|Site whereLogo($value)
 * @method static Builder|Site whereName($value)
 * @method static Builder|Site whereStatus($value)
 * @method static Builder|Site whereUpdatedAt($value)
 * @method static Builder|Site whereUrl($value)
 * @mixin \Eloquent
 */
class Site extends Model
{
    use HasFactory, SearchTrait;

    protected $casts = [
        'status' => DefaultStatusEnum::class,
    ];

    protected array $searchFields = [
        'id'         => 'match',
        'name'       => 'like',
        'status'     => 'match',
        'created_at' => 'date',
        'updated_at' => 'date',
    ];

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'entity_model');
    }

    public function paymentSystems(): MorphToMany
    {
        return $this->morphedByMany(PaymentSystem::class, 'entity_model');
    }

    public function pages(): MorphToMany
    {
        return $this->morphedByMany(Page::class, 'entity_model');
    }

    public function faqs(): MorphToMany
    {
        return $this->morphedByMany(Faq::class, 'entity_model');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
