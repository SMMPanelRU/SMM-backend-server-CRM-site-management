<?php

namespace Database\Seeders;

use App\Enum\DefaultStatusEnum;
use App\Models\AttributePredefinedValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Site;
use App\Models\Team;
use App\Models\User;
use App\Traits\EntityAttributeTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{

    use EntityAttributeTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                'name'              => [
                    'en' => 'IGTV VIDEO VIEWS (BUSINESS)',
                    'ru' => 'IGTV ПРОСМОТРЫ ВИДЕО (БИЗНЕС)',
                ],
                'short_description' => [
                    'en' => 'Fast views with coverage, instant start, stable.',
                    'ru' => 'Быстрые просмотры с охватом, мгновенный старт, стабильные.',
                ],
                'description'       => [
                    'en' => 'Stable standard quality views for IGTV. Adding reliable and stable views with a minimum chance of being written off will help increase the overall competitiveness of the video on the IGTV site and get into the list of popular - relevant videos. IGTV videos are available from the main Instagram application, as well as from a special program for smartphones IGTV, as well as videos can be opened in a browser via a URL link.

Quick views with instant start and reach for IGTV videos, the total maximum order of views is unlimited, minimum 1000 views. After placing an order, it automatically goes into processing within a few minutes. In special cases, there may be a delay in the start of up to 24 hours when the system is loaded. Adding views to a video quickly after publishing a video on IGTV increases the chances of a video being featured in the Featured category.

If you have any questions, you can not decide on the choice of service for Instagram TV, we provide highly qualified advice, please contact support after reviewing the answers to frequently asked questions. To date, the system provides unique services to increase the number of views on IGTV videos with the best prices. The maximum volume of views by several orders per video is unlimited!',
                    'ru' => 'Стабильные просмотры стандартного качества для IGTV. Добавление надёжных и стабильных по качеству просмотров с минимальным шансом списания, помогут увеличить общую конкурентоспособность ролика на площадке IGTV и попадание список популярных - актуальных видео роликов. Видеоролики IGTV доступны из главного приложения Instagram, так и из специальной программы для смартфонов IGTV, так же ролики возможно открыть в браузере по URL ссылке.

Быстрые просмотры с мгновенным стартом и охватом для видео IGTV, общий максимальный заказ просмотров неограничен, минимум 1000 просмотров. Заказ после его оформления автоматически поступает в обработку в течение нескольких минут. В особых случаях возможна задержка в старте до 24 часов при загруженности системы. Быстрое добавление просмотров на видео после публикации ролика в IGTV повышает шансы видео попасть в категорию Популярных.

Если у возникли вопросы, вы не можете определиться с выбором услуги для Инстаграм ТВ, мы предоставляем высококвалифицированную консультацию, обратитесь в службу поддержки предварительно изучив ответы на частые вопросы. На сегодняшний день система предоставляет уникальные услуги по увеличению числа просмотров у видео IGTV с лучшими ценами. Максимальный объем просмотров несколькими заказами на одно видео неограничен!',
                ],
                'price'             => 260,
                'old_price'         => 520,
                'multiplicity'      => 1000,
                'slug'              => 'inst-igtv-views-impressions',
                'status'            => DefaultStatusEnum::ON,
                'category'          => Category::query()->where('slug', 'instagram-igtv')->first()->id,
                'sites'             => [Site::query()->find(1)->id],
                'attributes'        => [
                    'min_count' => 1000,
                    'max_count' => 10000,
                ],
            ],

            [
                'name'              => [
                    'en' => 'IGTV VIDEO VIEWS (STANDARD)',
                    'ru' => 'IGTV ПРОСМОТРЫ ВИДЕО (СТАНДАРТ)',
                ],
                'short_description' => [
                    'en' => 'Standard views, high reliability and stable quality.',
                    'ru' => 'Стандартные просмотры, высокая надежность и стабильное качество.',
                ],
                'description'       => [
                    'en' => 'Stable standard quality views for IGTV. Adding reliable and stable views with a minimum chance of being written off will help increase the overall competitiveness of the video on the IGTV site and get into the list of popular - relevant videos. IGTV videos are available from the main Instagram application, as well as from a special program for smartphones IGTV, as well as videos can be opened in a browser via a URL link.

View orders for Instagram TV videos are processed instantly and without delay. To place an order, specify a direct link to the IGTV video. After registration, there is a quick launch of the order for IGTV views and its speedy execution. You will receive a notification about the status of execution to the specified e-mail when placing an order.

If you have any questions, you can’t decide on the choice of service for Instagram TV, we provide highly qualified advice, contact support after reviewing the answers to frequently asked questions. To date, the system provides unique services to increase the number of views on IGTV videos with the best prices. The maximum volume of views by several orders per video is unlimited!',
                    'ru' => 'Стабильные просмотры стандартного качества для IGTV. Добавление надёжных и стабильных по качеству просмотров с минимальным шансом списания, помогут увеличить общую конкурентоспособность ролика на площадке IGTV и попадание список популярных - актуальных видео роликов. Видеоролики IGTV доступны из главного приложения Instagram, так и из специальной программы для смартфонов IGTV, так же ролики возможно открыть в браузере по URL ссылке.

Заказы на просмотры для видеороликов Инстаграм ТВ система обрабатывает мгновенно и без задержек. Для оформления заказа, указывайте прямую ссылку на видео IGTV. После оформления, происходит быстрый запуск заказа по просмотрам IGTV и его скорое выполнение. Оповещение о статусе выполнения, вы получите на указанный e-mail при формировании заказа.

Если у возникли вопросы, вы не можете определиться с выбором услуги для Инстаграм ТВ, мы предоставляем высококвалифицированную консультацию, обратитесь в службу поддержки предварительно изучив ответы на частые вопросы. На сегодняшний день система предоставляет уникальные услуги по увеличению числа просмотров у видео IGTV с лучшими ценами. Максимальный объем просмотров несколькими заказами на одно видео неограничен!  ',
                ],
                'price'             => 140,
                'old_price'         => 280,
                'multiplicity'      => 1000,
                'slug'              => 'inst-igtv-views-standart',
                'status'            => DefaultStatusEnum::ON,
                'category'          => Category::query()->where('slug', 'instagram-igtv')->first()->id,
                'sites'             => Site::query()->pluck('id'),
                'attributes'        => [
                    'min_count' => 100,
                    'max_count' => 5000,
                ],
            ],
        ];


        $sort = 100;

        foreach ($products as $data) {
            $product                    = new Product();
            $product->name              = $data['name'];
            $product->short_description = $data['short_description'];
            $product->description       = $data['description'];
//            $product->price             = $data['price'];
//            $product->old_price         = $data['old_price'];
            $product->multiplicity = $data['multiplicity'];
            $product->slug         = $data['slug'];
            $product->status       = $data['status'];
            $product->sort         = $sort;

            $product->save();

            $product->categories()->attach([$data['category']]);
            $product->sites()->attach($data['sites']);

            foreach ($data['sites'] as $site) {
                $product->price()->create(
                    [
                        'site_id'   => $site,
                        'price'     => $data['price'],
                        'old_price' => $data['old_price'],
                    ]
                );
            }

            $this->updateEntityAttributes($product, $data['attributes']);

            $sort += 100;
        }

    }
}
