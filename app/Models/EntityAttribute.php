<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\EntityAttribute
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $entity_type
 * @property int $entity_id
 * @property int $attribute_id
 * @property int $attribute_value_id
 * @property-read \App\Models\Attribute $attribute
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttributeValue[] $attributeValues
 * @property-read int|null $attribute_values_count
 * @property-read Model|\Eloquent $entitiable
 * @method static Builder|EntityAttribute newModelQuery()
 * @method static Builder|EntityAttribute newQuery()
 * @method static Builder|EntityAttribute query()
 * @method static Builder|EntityAttribute whereAttributeId($value)
 * @method static Builder|EntityAttribute whereAttributeValueId($value)
 * @method static Builder|EntityAttribute whereCreatedAt($value)
 * @method static Builder|EntityAttribute whereEntityId($value)
 * @method static Builder|EntityAttribute whereEntityType($value)
 * @method static Builder|EntityAttribute whereId($value)
 * @method static Builder|EntityAttribute whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $entity_attribute_type
 * @property int $entity_attribute_id
 * @property-read \App\Models\AttributeValue $attributeValue
 * @method static Builder|EntityAttribute whereEntityAttributeId($value)
 * @method static Builder|EntityAttribute whereEntityAttributeType($value)
 */
class EntityAttribute extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['value', 'text_value'];

    public function entitiable()
    {
        return $this->morphTo(
            type: 'entity_attribute_type',
            id: 'entity_attribute_id',
        );
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeValue(): BelongsTo
    {
        return $this->belongsTo(AttributeValue::class);
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class);
    }
}
