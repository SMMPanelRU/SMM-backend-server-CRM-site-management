<?php

namespace App\Models;

use App\Enum\DefaultStatusEnum;
use App\Models\Traits\SearchTrait;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Product
 *
 * @property int                                                                        $id
 * @property \Illuminate\Support\Carbon|null                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                            $updated_at
 * @property array                                                                      $name
 * @property array                                                                      $short_description
 * @property array                                                                      $description
 * @property string                                                                     $slug
 * @property string|null                                                                $logo
 * @property int                                                                        $sort
 * @property string                                                                     $price
 * @property string|null                                                                $old_price
 * @property int                                                                        $multiplicity
 * @property int|null                                                                   $export_system_product_id
 * @property DefaultStatusEnum                                                          $status
 * @property string|null                                                                $name_en
 * @property string|null                                                                $name_ru
 * @property string|null                                                                $short_description_en
 * @property string|null                                                                $short_description_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttributeValue[] $attributes
 * @property-read int|null                                                              $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[]       $categories
 * @property-read int|null                                                              $categories_count
 * @property-read \App\Models\ExportSystemProduct|null                                  $exportSystemProduct
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Site[]           $sites
 * @property-read int|null                                                              $sites_count
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static Builder|Product forSite(\App\Models\Site $site)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product search($data = [])
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereExportSystemProductId($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereLogo($value)
 * @method static Builder|Product whereMultiplicity($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereNameEn($value)
 * @method static Builder|Product whereNameRu($value)
 * @method static Builder|Product whereOldPrice($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereShortDescription($value)
 * @method static Builder|Product whereShortDescriptionEn($value)
 * @method static Builder|Product whereShortDescriptionRu($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereSort($value)
 * @method static Builder|Product whereStatus($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, HasTranslations, SearchTrait;

    public array $translatable = ['name', 'short_description', 'description'];

    protected array $searchFields = [
        'name' => 'like',
        'slug' => 'like',
    ];

    protected $casts = [
        'status' => DefaultStatusEnum::class,
    ];

    public function scopeForSite(Builder $query, Site $site): Builder
    {
        return $query->whereHas('sites', function ($query) use ($site) {
            $query->where('product_sites.site_id', $site->id);
        });
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(AttributeValue::class, 'entity_attribute')->with(['attribute']);
    }

    public function sites(): MorphToMany
    {
        return $this->morphToMany(Site::class, 'entity_model');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories')->withTimestamps();
    }

    public function exportSystem(): BelongsTo
    {
        return $this->exportSystemProduct->exportSystem();
    }

    public function exportSystemProduct(): BelongsTo
    {
        return $this->belongsTo(ExportSystemProduct::class);
    }

}
