<?php

namespace App\Models;

use App\Enum\DefaultStatusEnum;
use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\ExportSystem
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array $name
 * @property DefaultStatusEnum $status
 * @property string $slug
 * @property string|null $logo
 * @property string|null $handler
 * @property array|null $settings
 * @property string|null $name_en
 * @property string|null $name_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExportSystemProduct[] $exportSystemProducts
 * @property-read int|null $export_system_products_count
 * @method static Builder|ExportSystem active()
 * @method static Builder|ExportSystem newModelQuery()
 * @method static Builder|ExportSystem newQuery()
 * @method static Builder|ExportSystem query()
 * @method static Builder|ExportSystem search($data = [])
 * @method static Builder|ExportSystem whereCreatedAt($value)
 * @method static Builder|ExportSystem whereHandler($value)
 * @method static Builder|ExportSystem whereId($value)
 * @method static Builder|ExportSystem whereLogo($value)
 * @method static Builder|ExportSystem whereName($value)
 * @method static Builder|ExportSystem whereNameEn($value)
 * @method static Builder|ExportSystem whereNameRu($value)
 * @method static Builder|ExportSystem whereSettings($value)
 * @method static Builder|ExportSystem whereSlug($value)
 * @method static Builder|ExportSystem whereStatus($value)
 * @method static Builder|ExportSystem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExportSystem extends Model
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

    public function exportSystemProducts(): HasMany
    {
        return $this->hasMany(ExportSystemProduct::class);
    }

}
