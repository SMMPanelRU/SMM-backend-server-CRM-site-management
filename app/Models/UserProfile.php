<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProfile
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property string $key
 * @property string $value
 * @method static Builder|UserProfile newModelQuery()
 * @method static Builder|UserProfile newQuery()
 * @method static Builder|UserProfile query()
 * @method static Builder|UserProfile whereCreatedAt($value)
 * @method static Builder|UserProfile whereId($value)
 * @method static Builder|UserProfile whereKey($value)
 * @method static Builder|UserProfile whereUpdatedAt($value)
 * @method static Builder|UserProfile whereUserId($value)
 * @method static Builder|UserProfile whereValue($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{

    public $fillable = [
        'user_id',
        'key',
        'value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
