<?php

namespace Database\Seeders;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Site;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $attributes = [
            Category::class => [
                'meta_title'       => [
                    'type'       => AttributeTypesEnum::Text,
                    'name'       => [
                        'en' => 'meta_title',
                        'ru' => 'meta_title',
                    ],
                    'slug'       => 'meta_title',
                    'searchable' => true,
                    'translatable' => true,
                ],
                'meta_description' => [
                    'type'       => AttributeTypesEnum::Textarea,
                    'name'       => [
                        'en' => 'meta_description',
                        'ru' => 'meta_description',
                    ],
                    'slug'       => 'meta_description',
                    'searchable' => false,
                    'translatable' => true,
                ],
            ],
            Product::class => [
                'meta_title'       => [
                    'type'       => AttributeTypesEnum::Text,
                    'name'       => [
                        'en' => 'meta_title',
                        'ru' => 'meta_title',
                    ],
                    'slug'       => 'meta_title',
                    'searchable' => true,
                    'translatable' => true,
                ],
                'meta_description' => [
                    'type'       => AttributeTypesEnum::Textarea,
                    'name'       => [
                        'en' => 'meta_description',
                        'ru' => 'meta_description',
                    ],
                    'slug'       => 'meta_description',
                    'searchable' => false,
                    'translatable' => true,
                ],
                'multiplicity_description'=> [
                    'type'=>AttributeTypesEnum::Select,
                    'name'       => [
                        'en' => 'Multiplicity description',
                        'ru' => 'Описание кратности',
                    ],
                    'slug'       => 'multiplicity_description',
                    'searchable' => false,
                    'translatable' => true,
                ],
                'min_count'=>[
                    'type'       => AttributeTypesEnum::Text,
                    'name'       => [
                        'en' => 'Min count',
                        'ru' => 'Минимальное количество',
                    ],
                    'slug'       => 'min_count',
                    'searchable' => false,
                    'translatable' => false,
                ],
                'max_count'=>[
                    'type'       => AttributeTypesEnum::Text,
                    'name'       => [
                        'en' => 'Max count',
                        'ru' => 'Максимальное количество',
                    ],
                    'slug'       => 'max_count',
                    'searchable' => false,
                    'translatable' => false,
                ]
            ],
            Page::class => [
                'meta_title'       => [
                    'type'       => AttributeTypesEnum::Text,
                    'name'       => [
                        'en' => 'meta_title',
                        'ru' => 'meta_title',
                    ],
                    'slug'       => 'meta_title',
                    'searchable' => true,
                    'translatable' => true,
                ],
                'meta_description' => [
                    'type'       => AttributeTypesEnum::Textarea,
                    'name'       => [
                        'en' => 'meta_description',
                        'ru' => 'meta_description',
                    ],
                    'slug'       => 'meta_description',
                    'searchable' => false,
                    'translatable' => true,
                ],
            ],
        ];

        foreach ($attributes as $entity => $data) {
            foreach ($data as $key => $values) {
                $attribute              = new Attribute();
                $attribute->name        = $values['name'];
                $attribute->type        = $values['type'];
                $attribute->slug        = $values['slug'];
                $attribute->entity_type = $entity;
                $attribute->is_searchable  = $values['searchable'];
                $attribute->is_translatable  = $values['translatable'];
                $attribute->save();
            }

        }

    }
}
