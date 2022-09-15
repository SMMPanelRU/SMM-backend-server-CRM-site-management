<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Site;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            'Instagram' => [
                'name'       => [
                    'en' => 'Instagram',
                    'ru' => 'Инстаграм',
                ],
                'slug'       => 'instagram',
                'categories' => [
                    'IGTV'        => [
                        'name' => [
                            'en' => 'IGTV',
                            'ru' => 'IGTV',
                        ],
                        'slug' => 'instagram-igtv',
                    ],
                    'Subscribers' => [
                        'name' => [
                            'en' => 'Subscribers',
                            'ru' => 'Подписчики',
                        ],
                        'slug' => 'instagram-subscribers',
                    ],
                    'Likes' => [
                        'name' => [
                            'en' => 'Likes',
                            'ru' => 'Лайки',
                        ],
                        'slug' => 'instagram-likes',
                    ],
                    'Views' => [
                        'name' => [
                            'en' => 'views',
                            'ru' => 'Просмотры',
                        ],
                        'slug' => 'instagram-views',
                    ],
                    'Live video' => [
                        'name' => [
                            'en' => 'Live video',
                            'ru' => 'Трансляции',
                        ],
                        'slug' => 'instagram-live-video',
                    ],
                    'Storys' => [
                        'name' => [
                            'en' => 'Storys',
                            'ru' => 'Истории',
                        ],
                        'slug' => 'instagram-storys',
                    ],
                    'Reports' => [
                        'name' => [
                            'en' => 'Reports',
                            'ru' => 'Жалобы',
                        ],
                        'slug' => 'instagram-reports',
                    ],
                    'Comments' => [
                        'name' => [
                            'en' => 'Comments',
                            'ru' => 'Комментарии',
                        ],
                        'slug' => 'instagram-comments',
                    ],
                    'Saved' => [
                        'name' => [
                            'en' => 'Saved',
                            'ru' => 'Сохранения',
                        ],
                        'slug' => 'instagram-saved',
                    ],
                    'Impressions' => [
                        'name' => [
                            'en' => 'Impressions',
                            'ru' => 'Охват и показы',
                        ],
                        'slug' => 'instagram-impressions',
                    ],
                    'Advertising' => [
                        'name' => [
                            'en' => 'Advertising',
                            'ru' => 'Реклама',
                        ],
                        'slug' => 'instagram-advertising',
                    ],
                    'Verification' => [
                        'name' => [
                            'en' => 'Verification',
                            'ru' => 'Верификация',
                        ],
                        'slug' => 'instagram-verification',
                    ],
                    'Media piar' => [
                        'name' => [
                            'en' => 'Media piar',
                            'ru' => 'VIP раскрутка',
                        ],
                        'slug' => 'instagram-media-piar',
                    ],
                    'Pack' => [
                        'name' => [
                            'en' => 'Pack',
                            'ru' => 'Наборы',
                        ],
                        'slug' => 'instagram-pack',
                    ],
                ],
            ],
            'Vkontakte' => [
                'name'       => [
                    'en' => 'Vkontakte',
                    'ru' => 'Вконтакте',
                ],
                'slug'       => 'vkontakte',
                'categories' => [],
            ],
            'Youtube'   => [
                'name'       => [
                    'en' => 'Youtube',
                    'ru' => 'Ютуб',
                ],
                'slug'       => 'youtube',
                'categories' => [],
            ],
            'TikTok'   => [
                'name'       => [
                    'en' => 'TikTok',
                    'ru' => 'ТикТок',
                ],
                'slug'       => 'tiktok',
                'categories' => [],
            ],
        ];

        $sort = 100;

        foreach ($categories as $name => $data) {
            $category       = new Category();
            $category->name = $data['name'];
            $category->slug = $data['slug'];
            $category->sort = $sort;

            $logoFile = storage_path('seed_files/assets/images/categories/'.$name.'.png');

            if (file_exists($logoFile)) {

                $uploaded = Storage::disk('public')->putFileAs('images/categories', $logoFile, $name.'.png');

                $category->logo = $uploaded;
            }

            $category->save();

            $sort += 100;
        }

        foreach ($categories as $name => $data) {
            $category = Category::query()->where('slug', $data['slug'])->first();
            if ($data['categories'] ?? null) {
                foreach ($data['categories'] as $subName => $subData) {
                    $subCategory              = new Category();
                    $subCategory->name        = $subData['name'];
                    $subCategory->slug        = $subData['slug'];
                    $subCategory->sort        = $sort;
                    $subCategory->category_id = $category->id;
                    $subCategory->save();

                    $sort += 100;
                }
            }
        }

    }
}
