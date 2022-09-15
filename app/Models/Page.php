<?php

namespace App\Models;

use App\Enum\DefaultStatusEnum;
use App\Models\Traits\SearchTrait;
use Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Page
 *
 * @property int                                                                        $id
 * @property \Illuminate\Support\Carbon|null                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                            $updated_at
 * @property array                                                                      $name
 * @property array|null                                                                 $short_description
 * @property array                                                                      $description
 * @property string                                                                     $slug
 * @property string|null                                                                $logo
 * @property DefaultStatusEnum                                                          $status
 * @property string|null                                                                $name_en
 * @property string|null                                                                $name_ru
 * @property string|null                                                                $short_description_en
 * @property string|null                                                                $short_description_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttributeValue[] $attributes
 * @property-read int|null                                                              $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Site[]           $sites
 * @property-read int|null                                                              $sites_count
 * @method static \Database\Factories\PageFactory factory(...$parameters)
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page search($data = [])
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereDescription($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereLogo($value)
 * @method static Builder|Page whereName($value)
 * @method static Builder|Page whereNameEn($value)
 * @method static Builder|Page whereNameRu($value)
 * @method static Builder|Page whereShortDescription($value)
 * @method static Builder|Page whereShortDescriptionEn($value)
 * @method static Builder|Page whereShortDescriptionRu($value)
 * @method static Builder|Page whereSlug($value)
 * @method static Builder|Page whereStatus($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    use HasFactory, SearchTrait, HasTranslations;

    public array $translatable = ['name', 'short_description', 'description'];

    protected array $searchFields = [
        'name' => 'like',
        'slug' => 'like',
    ];

    protected $casts = [
        'status' => DefaultStatusEnum::class,
    ];

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(AttributeValue::class, 'entity_attribute')->with(['attribute']);
    }

    public function sites(): MorphToMany
    {
        return $this->morphToMany(Site::class, 'entity_model');
    }
}
