<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderDetail
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $order_id
 * @property string                          $key
 * @property string                          $value
 * @property-read \App\Models\Order          $order
 * @method static Builder|OrderDetail newModelQuery()
 * @method static Builder|OrderDetail newQuery()
 * @method static Builder|OrderDetail query()
 * @method static Builder|OrderDetail whereCreatedAt($value)
 * @method static Builder|OrderDetail whereId($value)
 * @method static Builder|OrderDetail whereKey($value)
 * @method static Builder|OrderDetail whereOrderId($value)
 * @method static Builder|OrderDetail whereUpdatedAt($value)
 * @method static Builder|OrderDetail whereValue($value)
 * @mixin \Eloquent
 */
class OrderDetail extends Model
{
    use HasFactory;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
