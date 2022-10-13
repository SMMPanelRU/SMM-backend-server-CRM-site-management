<?php

namespace App\Models;

use App\Enum\Tickets\TicketStatusEnum;
use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Ticket
 *
 * @property int                                                                      $id
 * @property \Illuminate\Support\Carbon|null                                          $created_at
 * @property \Illuminate\Support\Carbon|null                                          $updated_at
 * @property TicketStatusEnum                                                         $status
 * @property int                                                                      $user_id
 * @property int                                                                      $site_id
 * @property string                                                                   $title
 * @property string                                                                   $body
 * @property \Illuminate\Support\Carbon|null                                          $closed_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketAnswer[] $answers
 * @property-read int|null                                                            $answers_count
 * @property-read \App\Models\Site                                                    $site
 * @property-read \App\Models\User                                                    $user
 * @method static Builder|Ticket newModelQuery()
 * @method static Builder|Ticket newQuery()
 * @method static Builder|Ticket query()
 * @method static Builder|Ticket search($data = [])
 * @method static Builder|Ticket whereBody($value)
 * @method static Builder|Ticket whereClosedAt($value)
 * @method static Builder|Ticket whereCreatedAt($value)
 * @method static Builder|Ticket whereId($value)
 * @method static Builder|Ticket whereSiteId($value)
 * @method static Builder|Ticket whereStatus($value)
 * @method static Builder|Ticket whereTitle($value)
 * @method static Builder|Ticket whereUpdatedAt($value)
 * @method static Builder|Ticket whereUserId($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\TicketFactory factory(...$parameters)
 */
class Ticket extends Model
{
    use HasFactory, SearchTrait;

    protected $casts = [
        'status'    => TicketStatusEnum::class,
        'closed_at' => 'datetime',
    ];

    protected array $searchFields = [
        'user_id'    => 'match',
        'site_id'    => 'match',
        'title'      => 'like',
        'status'     => 'match',
        'created_at' => 'date',
        'updated_at' => 'date',
        'closed_at'  => 'date',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(TicketAnswer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
