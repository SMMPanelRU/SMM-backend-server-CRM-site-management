<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\OrderDiscount
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $order_id
 * @property int|null $product_id
 * @property string $entity_type
 * @property int $entity_id
 * @method static Builder|OrderDiscount newModelQuery()
 * @method static Builder|OrderDiscount newQuery()
 * @method static Builder|OrderDiscount query()
 * @method static Builder|OrderDiscount whereCreatedAt($value)
 * @method static Builder|OrderDiscount whereEntityId($value)
 * @method static Builder|OrderDiscount whereEntityType($value)
 * @method static Builder|OrderDiscount whereId($value)
 * @method static Builder|OrderDiscount whereOrderId($value)
 * @method static Builder|OrderDiscount whereProductId($value)
 * @method static Builder|OrderDiscount whereUpdatedAt($value)
 * @method static Builder|OrderDiscount whereValue($value)
 * @mixin \Eloquent
 * @property-read Model|\Eloquent $entitiable
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product|null $product
 */
class OrderDiscount extends Model
{
    use HasFactory;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function entitiable(): MorphTo
    {
        return $this->morphTo(
            type: 'entity_type',
            id: 'entity_id'
        );
    }
}
