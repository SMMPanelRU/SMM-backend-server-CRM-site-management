<?php

namespace App\Models;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Attribute
 *
 * @property int                                                                                  $id
 * @property \Illuminate\Support\Carbon|null                                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                                      $updated_at
 * @property array                                                                                $name
 * @property AttributeTypesEnum                                                                   $type
 * @property string                                                                               $slug
 * @property string                                                                               $entity_type
 * @property bool                                                                                 $is_searchable
 * @property bool                                                                                 $is_translatable
 * @property string|null                                                                          $name_en
 * @property string|null                                                                          $name_ru
 * @property-read Model|\Eloquent                                                                 $entitiable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttributePredefinedValue[] $predefinedValues
 * @property-read int|null                                                                        $predefined_values_count
 * @method static Builder|Attribute newModelQuery()
 * @method static Builder|Attribute newQuery()
 * @method static Builder|Attribute query()
 * @method static Builder|Attribute search($data = [])
 * @method static Builder|Attribute whereCreatedAt($value)
 * @method static Builder|Attribute whereEntityType($value)
 * @method static Builder|Attribute whereId($value)
 * @method static Builder|Attribute whereName($value)
 * @method static Builder|Attribute whereNameEn($value)
 * @method static Builder|Attribute whereNameRu($value)
 * @method static Builder|Attribute whereSearchable($value)
 * @method static Builder|Attribute whereSlug($value)
 * @method static Builder|Attribute whereType($value)
 * @method static Builder|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static Builder|Attribute whereIsSearchable($value)
 * @method static Builder|Attribute whereIsTranslatable($value)
 */
class Attribute extends Model
{
    use HasFactory, HasTranslations, SearchTrait;

    protected $casts = [
        'type'       => AttributeTypesEnum::class,
    ];

    protected array $searchFields = [
        'name'        => 'like',
        'slug'        => 'like',
        'type'        => 'match',
        'entity_type' => 'match',
        'created_at'  => 'date',
        'updated_at'  => 'date',
    ];

    public array $translatable = ['name'];

    public function entitiable(): MorphTo
    {
        return $this->morphTo(
            type: 'entity_type',
        );
    }

    public function predefinedValues(): HasMany
    {
        return $this->hasMany(AttributePredefinedValue::class);
    }

//    public function entities()
//    {
//        return $this->belongsToMany('App\Product')
//                    ->withPivot('value')
//                    ->using('App\ProductAttributes');
//    }
}
