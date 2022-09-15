<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\EntityModel
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string                          $entity_model_type
 * @property int                             $entity_model_id
 * @property int                             $site_id
 * @property-read Model|\Eloquent            $entitiable
 * @property-read \App\Models\Product|null   $products
 * @method static Builder|EntityModel newModelQuery()
 * @method static Builder|EntityModel newQuery()
 * @method static Builder|EntityModel query()
 * @method static Builder|EntityModel whereCreatedAt($value)
 * @method static Builder|EntityModel whereEntityModelId($value)
 * @method static Builder|EntityModel whereEntityModelType($value)
 * @method static Builder|EntityModel whereId($value)
 * @method static Builder|EntityModel whereSiteId($value)
 * @method static Builder|EntityModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EntityModel extends Model
{
    use HasFactory;

    public function entitiable(): MorphTo
    {
        return $this->morphTo(
            type: 'entity_model_type',
            id: 'entity_model_id',
        );
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
