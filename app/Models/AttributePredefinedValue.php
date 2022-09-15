<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;


/**
 * App\Models\AttributePredefinedValue
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $attribute_id
 * @property array                           $value
 * @property string|null                     $value_en
 * @property string|null                     $value_ru
 * @property-read \App\Models\Attribute      $attribute
 * @method static Builder|AttributePredefinedValue newModelQuery()
 * @method static Builder|AttributePredefinedValue newQuery()
 * @method static Builder|AttributePredefinedValue query()
 * @method static Builder|AttributePredefinedValue whereAttributeId($value)
 * @method static Builder|AttributePredefinedValue whereCreatedAt($value)
 * @method static Builder|AttributePredefinedValue whereId($value)
 * @method static Builder|AttributePredefinedValue whereUpdatedAt($value)
 * @method static Builder|AttributePredefinedValue whereValue($value)
 * @method static Builder|AttributePredefinedValue whereValueEn($value)
 * @method static Builder|AttributePredefinedValue whereValueRu($value)
 * @mixin \Eloquent
 */
class AttributePredefinedValue extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['value'];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
