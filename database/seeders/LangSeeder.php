<?php

namespace Database\Seeders;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Enum\DefaultStatusEnum;
use App\Enum\EnumTrait;
use App\Models\Category;
use App\Models\Product;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        LanguageLine::query()->truncate();;

        $this->texts();
        $this->entities();
        $this->enums();

    }

    private function texts()
    {
        $texts = [
            'pagination' => [
                'show'    => ['en' => 'show', 'ru' => 'показывать'],
                'entries' => ['en' => 'entries', 'ru' => 'записей'],
                'showing' => ['en' => 'showing', 'ru' => 'отображается'],
                'of'      => ['en' => 'of', 'ru' => 'из'],
            ],
            'fields'     => [
                'name'   => ['en' => 'name', 'ru' => 'название'],
                'slug'   => ['en' => 'slug', 'ru' => 'код'],
                'sort'   => ['en' => 'sort', 'ru' => 'сортировка'],
                'logo'   => ['en' => 'logo', 'ru' => 'лого'],
                'parent' => ['en' => 'parent', 'ru' => 'родитель'],
                'choose' => ['en' => 'choose', 'ru' => 'выбрать'],
            ],
            'forms'      => [
                'save'   => ['en' => 'save', 'ru' => 'сохранить'],
                'create' => ['en' => 'create', 'ru' => 'создать'],
                'delete' => ['en' => 'delete', 'ru' => 'удалить'],
            ],
        ];

        foreach ($texts as $group => $values) {
            foreach ($values as $key => $value) {
                LanguageLine::query()->create([
                    'group' => $group,
                    'key'   => $key,
                    'text'  => $value,
                ]);
            }
        }
    }

    private function entities()
    {

        $entities = [
            Category::class => ['en' => 'category', 'ru' => 'категория'],
            Site::class     => ['en' => 'site', 'ru' => 'сайт'],
            Product::class  => ['en' => 'product', 'ru' => 'товар'],
        ];

        foreach ($entities as $key => $value) {
            LanguageLine::query()->create([
                'group' => 'entities',
                'key'   => $key,
                'text'  => $value,
            ]);
        }

    }

    private function enums()
    {

        $enums = [
            DefaultStatusEnum::class . '.' . DefaultStatusEnum::OFF->name => ['en' => 'OFF', 'ru' => 'Выкл'],
            DefaultStatusEnum::class . '.' . DefaultStatusEnum::ON->name  => ['en' => 'ON', 'ru' => 'Вкл'],
        ];

        foreach ($enums as $key => $value) {
            LanguageLine::query()->create([
                'group' => 'enums',
                'key'   => $key,
                'text'  => $value,
            ]);
        }

    }
}
