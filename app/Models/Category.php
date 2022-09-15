<?php

namespace App\Models;

use App\Models\Traits\SearchTrait;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Category
 *
 * @property int                                                                   $id
 * @property \Illuminate\Support\Carbon|null                                       $created_at
 * @property \Illuminate\Support\Carbon|null                                       $updated_at
 * @property mixed                                                                 $name
 * @property string                                                                $slug
 * @property string|null                                                           $logo
 * @property int                                                                   $sort
 * @property int|null                                                              $category_id
 * @method static CategoryFactory factory(...$parameters)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCategoryId($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereIcon($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereSort($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[]              $childCategories
 * @property-read int|null                                                         $child_categories_count
 * @property-read Category|null                                                    $parentCategory
 * @method static Builder|Category whereLogo($value)
 * @property string|null                                                           $en
 * @property string|null                                                           $ru
 * @method static Builder|Category search($data = [])
 * @method static Builder|Category whereEn($value)
 * @method static Builder|Category whereRu($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attribute[] $attributes
 * @property-read int|null                                                         $attributes_count
 * @property string|null $name_en
 * @property string|null $name_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|Category whereNameEn($value)
 * @method static Builder|Category whereNameRu($value)
 */
class Category extends Model
{
    use HasFactory, HasTranslations, SearchTrait;

    public array $translatable = ['name'];

    protected array $searchFields = [
        'name'       => 'like',
        'slug'       => 'like',
        'created_at' => 'date',
        'updated_at' => 'date',
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function childCategories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(AttributeValue::class, 'entity_attribute')->with('attribute');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories')->withTimestamps();
    }
}
