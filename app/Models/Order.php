<?php

namespace App\Models;

use App\Enum\Orders\OrderStatusEnum;
use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Order
 *
 * @property int                                                                     $id
 * @property \Illuminate\Support\Carbon|null                                         $created_at
 * @property \Illuminate\Support\Carbon|null                                         $updated_at
 * @property int                                                                     $user_id
 * @property int                                                                     $site_id
 * @property int                                                                     $payment_system_id
 * @property float                                                                   $amount
 * @property float                                                                   $discount
 * @property OrderStatusEnum                                                         $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDetail[] $details
 * @property-read int|null                                                           $details_count
 * @property-read \App\Models\PaymentSystem                                          $paymentSystem
 * @property-read \App\Models\Site                                                   $site
 * @property-read \App\Models\User                                                   $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order search($data = [])
 * @method static Builder|Order whereAmount($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDiscount($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order wherePaymentSystemId($value)
 * @method static Builder|Order whereSiteId($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDiscount[] $discounts
 * @property-read int|null $discounts_count
 */
class Order extends Model
{
    use HasFactory, SearchTrait;

    public string $paymentForm;

    protected array $searchFields = [
        'user_id' => 'match',
        'site_id' => 'match',
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function paymentSystem(): BelongsTo
    {
        return $this->belongsTo(PaymentSystem::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(OrderDiscount::class);
    }

    public function paymentAmount(): float
    {
        return $this->amount - $this->discount;
    }
}
