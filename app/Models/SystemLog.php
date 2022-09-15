<?php

namespace App\Models;

use App\Enum\SystemLogs\SystemLogTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\SystemLog
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $class
 * @property string|null $method
 * @property string|null $index
 * @property SystemLogTypeEnum|null $type
 * @property string|null $message
 * @property array|null $data
 * @method static Builder|SystemLog newModelQuery()
 * @method static Builder|SystemLog newQuery()
 * @method static Builder|SystemLog query()
 * @method static Builder|SystemLog whereClass($value)
 * @method static Builder|SystemLog whereCreatedAt($value)
 * @method static Builder|SystemLog whereData($value)
 * @method static Builder|SystemLog whereId($value)
 * @method static Builder|SystemLog whereIndex($value)
 * @method static Builder|SystemLog whereMessage($value)
 * @method static Builder|SystemLog whereMethod($value)
 * @method static Builder|SystemLog whereType($value)
 * @method static Builder|SystemLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SystemLog extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => SystemLogTypeEnum::class,
        'data' => 'array',
    ];
}
