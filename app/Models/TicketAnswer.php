<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TicketAnswer
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ticket_id
 * @property int|null $user_id
 * @property int|null $admin_id
 * @property string $body
 * @property-read \App\Models\User|null $admin
 * @property-read \App\Models\Ticket $ticket
 * @property-read \App\Models\User|null $user
 * @method static Builder|TicketAnswer newModelQuery()
 * @method static Builder|TicketAnswer newQuery()
 * @method static Builder|TicketAnswer query()
 * @method static Builder|TicketAnswer whereAdminId($value)
 * @method static Builder|TicketAnswer whereBody($value)
 * @method static Builder|TicketAnswer whereCreatedAt($value)
 * @method static Builder|TicketAnswer whereId($value)
 * @method static Builder|TicketAnswer whereTicketId($value)
 * @method static Builder|TicketAnswer whereUpdatedAt($value)
 * @method static Builder|TicketAnswer whereUserId($value)
 * @mixin \Eloquent
 */
class TicketAnswer extends Model
{
    use HasFactory;

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
