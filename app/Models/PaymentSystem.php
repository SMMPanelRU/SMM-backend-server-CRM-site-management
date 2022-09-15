<?php

namespace App\Models;

use App\Enum\DefaultStatusEnum;
use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\PaymentSystem
 *
 * @property int                                                              $id
 * @property \Illuminate\Support\Carbon|null                                  $created_at
 * @property \Illuminate\Support\Carbon|null                                  $updated_at
 * @property array                                                            $name
 * @property DefaultStatusEnum                                                $status
 * @property string                                                           $slug
 * @property string|null                                                      $logo
 * @property string|null                                                      $handler
 * @property array|null                                                       $settings
 * @property string|null                                                      $name_en
 * @property string|null                                                      $name_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Site[] $sites
 * @property-read int|null                                                    $sites_count
 * @method static Builder|PaymentSystem active()
 * @method static Builder|PaymentSystem forSite(\App\Models\Site $site)
 * @method static Builder|PaymentSystem newModelQuery()
 * @method static Builder|PaymentSystem newQuery()
 * @method static Builder|PaymentSystem query()
 * @method static Builder|PaymentSystem search($data = [])
 * @method static Builder|PaymentSystem whereCreatedAt($value)
 * @method static Builder|PaymentSystem whereHandler($value)
 * @method static Builder|PaymentSystem whereId($value)
 * @method static Builder|PaymentSystem whereLogo($value)
 * @method static Builder|PaymentSystem whereName($value)
 * @method static Builder|PaymentSystem whereNameEn($value)
 * @method static Builder|PaymentSystem whereNameRu($value)
 * @method static Builder|PaymentSystem whereSettings($value)
 * @method static Builder|PaymentSystem whereSlug($value)
 * @method static Builder|PaymentSystem whereStatus($value)
 * @method static Builder|PaymentSystem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentSystem extends Model
{
    use HasFactory, HasTranslations, SearchTrait;

    public array $translatable = ['name'];

    protected array $searchFields = [
        'name' => 'like',
        'slug' => 'like',
    ];

    protected $casts = [
        'status'   => DefaultStatusEnum::class,
        'settings' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where(['status' => DefaultStatusEnum::ON]);
    }

    public function scopeForSite(Builder $query, Site $site): Builder
    {
        return $query->whereHas('sites', function ($query) use ($site) {
            $query->where('product_sites.site_id', $site->id);
        });
    }

    public function sites(): MorphToMany
    {
        return $this->morphToMany(Site::class, 'entity_model');
    }

}
