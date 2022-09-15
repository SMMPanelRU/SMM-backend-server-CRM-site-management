<?php

namespace Database\Seeders;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Models\Attribute;
use App\Models\AttributePredefinedValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\Site;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AttributePredefinedValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $attributes = [
            'multiplicity_description' => [
                'values' => [
                    [
                        'en' => 'subscribers',
                        'ru' => 'подписчики',
                    ],
                    [
                        'en' => 'likes',
                        'ru' => 'лайки',
                    ],
                    [
                        'en' => 'views',
                        'ru' => 'просмотры',
                    ],
                ],
            ],

        ];

        foreach ($attributes as $slug => $data) {
            $attribute = Attribute::query()->where(['slug'=>$slug])->first();
            foreach ($data['values'] as $item) {
                $attributePredefinedValue = new AttributePredefinedValue();
                $attributePredefinedValue->attribute()->associate($attribute);
                $attributePredefinedValue->value = $item;
                $attributePredefinedValue->save();
            }
        }

    }
}
