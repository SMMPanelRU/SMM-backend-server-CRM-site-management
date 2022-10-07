<?php

namespace App\Models;

use App\Models\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Currency
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array                           $name
 * @property string                          $code
 * @property string                          $icon
 * @property string|null                     $course
 * @property string|null                     $name_en
 * @property string|null                     $name_ru
 * @method static Builder|Currency newModelQuery()
 * @method static Builder|Currency newQuery()
 * @method static Builder|Currency query()
 * @method static Builder|Currency search($data = [])
 * @method static Builder|Currency whereCode($value)
 * @method static Builder|Currency whereCourse($value)
 * @method static Builder|Currency whereCreatedAt($value)
 * @method static Builder|Currency whereIcon($value)
 * @method static Builder|Currency whereId($value)
 * @method static Builder|Currency whereName($value)
 * @method static Builder|Currency whereNameEn($value)
 * @method static Builder|Currency whereNameRu($value)
 * @method static Builder|Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    use HasFactory, HasTranslations, SearchTrait;

    public array $translatable = ['name'];

    protected array $searchFields = [
        'name' => 'like',
        'code' => 'like',
    ];

}
