<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ManualOrder
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $user_id
 * @property string                          $amount
 * @property string                          $description
 * @property int                             $admin_id
 * @property-read \App\Models\User           $admin
 * @property-read \App\Models\User           $user
 * @method static Builder|ManualOrder newModelQuery()
 * @method static Builder|ManualOrder newQuery()
 * @method static Builder|ManualOrder query()
 * @method static Builder|ManualOrder whereAdminId($value)
 * @method static Builder|ManualOrder whereAmount($value)
 * @method static Builder|ManualOrder whereCreatedAt($value)
 * @method static Builder|ManualOrder whereDescription($value)
 * @method static Builder|ManualOrder whereId($value)
 * @method static Builder|ManualOrder whereUpdatedAt($value)
 * @method static Builder|ManualOrder whereUserId($value)
 * @mixin \Eloquent
 */
class ManualOrder extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
