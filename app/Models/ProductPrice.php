<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ProductPrice
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $product_id
 * @property int                             $site_id
 * @property string                          $price
 * @property string|null                     $old_price
 * @property-read \App\Models\Product        $product
 * @property-read \App\Models\Site           $site
 * @method static Builder|ProductPrice newModelQuery()
 * @method static Builder|ProductPrice newQuery()
 * @method static Builder|ProductPrice query()
 * @method static Builder|ProductPrice whereCreatedAt($value)
 * @method static Builder|ProductPrice whereId($value)
 * @method static Builder|ProductPrice whereOldPrice($value)
 * @method static Builder|ProductPrice wherePrice($value)
 * @method static Builder|ProductPrice whereProductId($value)
 * @method static Builder|ProductPrice whereSiteId($value)
 * @method static Builder|ProductPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductPrice extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
