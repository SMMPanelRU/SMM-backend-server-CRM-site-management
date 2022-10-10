<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserBalance
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $user_id
 * @property float                           $balance
 * @property-read \App\Models\User           $user
 * @method static Builder|UserBalance newModelQuery()
 * @method static Builder|UserBalance newQuery()
 * @method static Builder|UserBalance query()
 * @method static Builder|UserBalance whereBalance($value)
 * @method static Builder|UserBalance whereCreatedAt($value)
 * @method static Builder|UserBalance whereId($value)
 * @method static Builder|UserBalance whereUpdatedAt($value)
 * @method static Builder|UserBalance whereUserId($value)
 * @mixin \Eloquent
 */
class UserBalance extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
