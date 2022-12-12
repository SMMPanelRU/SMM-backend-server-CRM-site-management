<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DiscountProduct
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $product_id
 * @property int                             $count
 * @property string                          $discount
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DiscountProduct extends Model {
    use HasFactory;

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

}
