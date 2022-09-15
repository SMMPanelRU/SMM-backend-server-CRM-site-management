<?php

namespace App\Models;

use App\Enum\DefaultStatusEnum;
use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ExportSystemProduct
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $export_system_id
 * @property string                          $name
 * @property string                          $unique_id
 * @property DefaultStatusEnum               $status
 * @property string|null                     $price
 * @property int|null                        $min
 * @property int|null                        $max
 * @property array|null                      $data
 * @property-read \App\Models\ExportSystem   $exportSystem
 * @method static Builder|ExportSystemProduct newModelQuery()
 * @method static Builder|ExportSystemProduct newQuery()
 * @method static Builder|ExportSystemProduct query()
 * @method static Builder|ExportSystemProduct search($data = [])
 * @method static Builder|ExportSystemProduct whereCreatedAt($value)
 * @method static Builder|ExportSystemProduct whereData($value)
 * @method static Builder|ExportSystemProduct whereExportSystemId($value)
 * @method static Builder|ExportSystemProduct whereId($value)
 * @method static Builder|ExportSystemProduct whereMax($value)
 * @method static Builder|ExportSystemProduct whereMin($value)
 * @method static Builder|ExportSystemProduct whereName($value)
 * @method static Builder|ExportSystemProduct wherePrice($value)
 * @method static Builder|ExportSystemProduct whereStatus($value)
 * @method static Builder|ExportSystemProduct whereUniqueId($value)
 * @method static Builder|ExportSystemProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExportSystemProduct extends Model
{
    use HasFactory, SearchTrait;

    protected $guarded = ['id'];

    protected array $searchFields = [
        'name'      => 'like',
        'unique_id' => 'like',
    ];

    protected $casts = [
        'status' => DefaultStatusEnum::class,
        'data'   => 'object',
    ];

    public function exportSystem(): BelongsTo
    {
        return $this->belongsTo(ExportSystem::class);
    }
}
