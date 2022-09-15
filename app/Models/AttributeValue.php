<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\AttributeValue
 *
 * @property int                                   $id
 * @property \Illuminate\Support\Carbon|null       $created_at
 * @property \Illuminate\Support\Carbon|null       $updated_at
 * @property int                                   $attribute_id
 * @property array|null                            $value
 * @property string|null                           $value_en
 * @property string|null                           $value_ru
 * @property array|null                            $text_value
 * @property string|null                           $non_translatable_value
 * @property int|null                              $attribute_predefined_value_id
 * @property-read \App\Models\Attribute            $attribute
 * @property-read \App\Models\EntityAttribute|null $entityAttribute
 * @method static Builder|AttributeValue newModelQuery()
 * @method static Builder|AttributeValue newQuery()
 * @method static Builder|AttributeValue query()
 * @method static Builder|AttributeValue whereAttributeId($value)
 * @method static Builder|AttributeValue whereAttributePredefinedValueId($value)
 * @method static Builder|AttributeValue whereCreatedAt($value)
 * @method static Builder|AttributeValue whereId($value)
 * @method static Builder|AttributeValue whereTextValue($value)
 * @method static Builder|AttributeValue whereUpdatedAt($value)
 * @method static Builder|AttributeValue whereValue($value)
 * @method static Builder|AttributeValue whereValueEn($value)
 * @method static Builder|AttributeValue whereValueRu($value)
 * @mixin \Eloquent
 * @method static Builder|AttributeValue whereNonTranslatableValue($value)
 */
class AttributeValue extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['value', 'text_value'];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class)->with('predefinedValues');
    }

    public function entityAttribute(): HasOne
    {
        return $this->hasOne(EntityAttribute::class);
    }
}
