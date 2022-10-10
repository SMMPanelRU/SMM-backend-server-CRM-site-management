<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\UserBalanceHistory
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $user_balance_id
 * @property string                          $entity_type
 * @property int                             $entity_id
 * @property float                           $amount
 * @property float                           $balance
 * @property float                           $old_balance
 * @property string|null                     $description
 * @property-read Model|\Eloquent            $entitiable
 * @property-read \App\Models\UserBalance    $userBalance
 * @method static Builder|UserBalanceHistory newModelQuery()
 * @method static Builder|UserBalanceHistory newQuery()
 * @method static Builder|UserBalanceHistory query()
 * @method static Builder|UserBalanceHistory whereAmount($value)
 * @method static Builder|UserBalanceHistory whereBalance($value)
 * @method static Builder|UserBalanceHistory whereCreatedAt($value)
 * @method static Builder|UserBalanceHistory whereDescription($value)
 * @method static Builder|UserBalanceHistory whereEntityId($value)
 * @method static Builder|UserBalanceHistory whereEntityType($value)
 * @method static Builder|UserBalanceHistory whereId($value)
 * @method static Builder|UserBalanceHistory whereOldBalance($value)
 * @method static Builder|UserBalanceHistory whereUpdatedAt($value)
 * @method static Builder|UserBalanceHistory whereUserBalanceId($value)
 * @mixin \Eloquent
 */
class UserBalanceHistory extends Model
{
    use HasFactory;

    public function entitiable(): MorphTo
    {
        return $this->morphTo(
            type: 'entity_type',
            id: 'entity_id'
        );
    }

    public function userBalance(): BelongsTo
    {
        return $this->belongsTo(UserBalance::class);
    }
}
