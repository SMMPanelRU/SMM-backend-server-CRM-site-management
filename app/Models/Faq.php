<?php

namespace App\Models;

use App\Enum\DefaultStatusEnum;
use App\Models\Traits\SearchTrait;
use Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Faq
 *
 * @property int                                                              $id
 * @property \Illuminate\Support\Carbon|null                                  $created_at
 * @property \Illuminate\Support\Carbon|null                                  $updated_at
 * @property array                                                            $question
 * @property array                                                            $answer
 * @property DefaultStatusEnum                                                $status
 * @property string|null                                                      $question_en
 * @property string|null                                                      $question_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Site[] $sites
 * @property-read int|null                                                    $sites_count
 * @method static FaqFactory factory(...$parameters)
 * @method static Builder|Faq newModelQuery()
 * @method static Builder|Faq newQuery()
 * @method static Builder|Faq query()
 * @method static Builder|Faq search($data = [])
 * @method static Builder|Faq whereAnswer($value)
 * @method static Builder|Faq whereCreatedAt($value)
 * @method static Builder|Faq whereId($value)
 * @method static Builder|Faq whereQuestion($value)
 * @method static Builder|Faq whereQuestionEn($value)
 * @method static Builder|Faq whereQuestionRu($value)
 * @method static Builder|Faq whereStatus($value)
 * @method static Builder|Faq whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Faq extends Model
{
    use HasFactory, SearchTrait, HasTranslations;

    public array $translatable = ['question', 'answer'];

    protected array $searchFields = [
        'question' => 'like',
    ];

    protected $casts = [
        'status' => DefaultStatusEnum::class,
    ];

    public function sites(): MorphToMany
    {
        return $this->morphToMany(Site::class, 'entity_model');
    }
}
