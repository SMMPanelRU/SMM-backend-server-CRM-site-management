<?php

namespace App\Models;

use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\TranslationLoader\LanguageLine;

/**
 * App\Models\Translation
 *
 * @property int                             $id
 * @property string                          $group
 * @property string                          $key
 * @property array                           $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $text_en
 * @property string|null                     $text_ru
 * @method static Builder|Translation newModelQuery()
 * @method static Builder|Translation newQuery()
 * @method static Builder|Translation query()
 * @method static Builder|Translation search($data = [])
 * @method static Builder|Translation whereCreatedAt($value)
 * @method static Builder|Translation whereGroup($value)
 * @method static Builder|Translation whereId($value)
 * @method static Builder|Translation whereKey($value)
 * @method static Builder|Translation whereText($value)
 * @method static Builder|Translation whereTextEn($value)
 * @method static Builder|Translation whereTextRu($value)
 * @method static Builder|Translation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Translation extends LanguageLine
{

    use HasFactory, SearchTrait;

    protected $table = 'language_lines';

    protected array $searchFields = [
        'id'      => 'match',
        'group'   => 'like',
        'key'     => 'like',
        'text_ru' => 'like',
        'text_en' => 'like',
    ];

}
