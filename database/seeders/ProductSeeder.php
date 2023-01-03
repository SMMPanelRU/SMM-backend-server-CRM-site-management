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
            [
                'name'              => [
                    'en' => 'SUBSCRIBERS TO THE GROUP AND PUBLIC (VK ECONOMY)',
                    'ru' => 'ПОДПИСЧИКИ В ГРУППУ И ПАБЛИК (ВК ЭКОНОМ)',
                ],
                'short_description' => [
                    'en' => 'Audience from the Russian stock exchange and sites. Fast and inexpensive without bots.',
                    'ru' => 'Аудитория с российской биржи и сайтов. Быстро и недорого без ботов.',
                ],
                'description'       => [
                    'en' => 'Vkontakte is one of the most popular social networks in Russia. This social the network attracts users with a wide range of functions. Listening to music, chatting with friends, as well as various groups and communities. For the service, the order fulfillment speed is minimal, up to 3,000 thousand per month to the entertainment community.

Groups on Vkontakte come in a variety of directions and topics, and any user can create them for free. If you plan to create (or have already created) a community on Vkontakte and want to gather an audience, you can use the group promotion function.

Added audience from the Russian exchange, so new users will be Russian. The speed of this order is minimal (up to 3000 new users per month). Take advantage of the opportunities provided and develop your groups.',
                    'ru' => 'Вконтакте - это одна из самых популярных социальных сетей в России. Данная соц. сеть привлекает пользователей широким спектром функций. Прослушивание музыки, общение с друзьями, а также различные группы и сообщества. По услуге скорость выполнения заказа минимальная, до 3000 тысяч в месяц в сообщество развлекательной тематики.

Группы во Вконтакте бывают самой разной направленности и тематики, а создать их может любой пользователь совершенно бесплатно. Если вы планируете создать (или уже создали) сообщество во Вконтакте и хотите собрать аудиторию, то можете воспользоваться функцией раскрутки группы.

Добавленная аудитория с русской биржи, поэтому новые пользователи будут русские. Скорость выполнения данного заказа минимальна (до 3000 новых пользователей в месяц). Пользуйтесь предоставленными возможностями и развивайте свои группы.',
                ],
                'price'             => 140,
                'old_price'         => 280,
                'multiplicity'      => 1000,
                'slug'              => 'vk-groups-subscribers-low',
                'status'            => DefaultStatusEnum::ON,
                'category'          => Category::query()->where('slug', 'vkontakte-subscribers')->first()->id,
                'sites'             => Site::query()->pluck('id'),
                'attributes'        => [
                    'min_count' => 100,
                    'max_count' => 5000,
                ],
            ],
            [
                'name'              => [
                    'en' => 'SUBSCRIBERS TO THE GROUP AND PUBLIC (VK ECONOMY+)',
                    'ru' => 'ПОДПИСЧИКИ В ГРУППУ И ПАБЛИК (ВК ЭКОНОМ+)',
                ],
                'short_description' => [
                    'en' => 'Quickly add subscribers (low quality) without limits.',
                    'ru' => 'Быстрое добавление подписчиков (низкого качества) без ограничений.',
                ],
                'description'       => [
                    'en' => 'Our service allows you to quickly recruit subscribers to a group or public page! This service works without delay delay. There is no order speed limit. Before placing an order, we recommend that you read the terms of service and basic information from the VK FAQ.

A group or public page must have at least 15 community posts. When ordering from 20,000 subscribers, you get a +10% bonus to your order for free!

Subscriptions are carried out at the expense of offers and bots from Russia and the CIS countries. There are chances of doggies as well. Write-offs of subscribers are rare, but it is not excluded. There is no guarantee (recovery) when writing off subscribers for this service. Dogs that may appear, pass through time. The low cost of the service is due to the mixed quality of adding members (subscribers) to the community.',
                    'ru' => 'Наш сервис позволяет в кратчайшие сроки набрать подписчиков в группу или публичную страницу! Данная услуга работает без задержки задержкой. Отсутствует ограничение по скорости заказа. Перед оформлением заказа рекомендуем ознакомиться с правилами сервиса и основной информацией из FAQ по VK.

У группы или публичной страницы должно быть минимум 15 записей от имени сообщества. При заказе от 20.000 подписчиков, вы получаете бонус +10% к вашему заказу совершенно бесплатно!

Подписки осуществляем за счет офферов и ботов из России и стан СНГ. Есть вероятность появления собачек, а также. Списания подписчиков происходит редко, но оно не исключено. Гарантии (восстановления) при списания подписчиков по данной услуге нет. Собачки которые могут появляются, через время проходят. Невысокая стоимость услуги, обусловлена смешенным качеством добавления участников (подписчиков) в сообщество.',
                ],
                'price'             => 140,
                'old_price'         => 280,
                'multiplicity'      => 1000,
                'slug'              => 'vk-groups-unlimited',
                'status'            => DefaultStatusEnum::ON,
                'category'          => Category::query()->where('slug', 'vkontakte-subscribers')->first()->id,
                'sites'             => Site::query()->pluck('id'),
                'attributes'        => [
                    'min_count' => 100,
                    'max_count' => 5000,
                ],
            ],
            [
                'name'              => [
                    'en' => 'I LIKE - LIKE VK (FAST START)',
                    'ru' => 'МНЕ НРАВИТСЯ – ЛАЙКИ ВК (БЫСТРЫЙ СТАРТ)',
                ],
                'short_description' => [
                    'en' => 'Order the service of adding hearts to a record, photo, comment or video.',
                    'ru' => 'Заказать услугу добавление сердечек на запись, фото, комментарий или видео.',
                ],
                'description'       => [
                    'en' => 'In the system, you have the opportunity to issue and order an automatic service for cheating hearts (likes) on the VKontakte social network. The winding of hearts occurs with a minimum delay. You can track the status of the order in your personal account, in real time.﻿

Likes are added almost instantly to the post, photo, video or comment that you specify in the link field. For bulk orders, discounts of up to 30% are possible according to the tariff of the discount system. Pages from which likes are placed, mainly from Russia and the CIS countries.

Complete the order form and pay for it. After that, the order will go to work and will be completed within a few minutes (in cases of a large queue, there may be delays for large orders). The service is absolutely safe for personal pages, groups and publics.',
                    'ru' => 'В системе вы имеете возможность оформить и заказать автоматическую услугу накрутки сердечек (лайков) в социальной сети ВКонтакте. Накрутка сердечек происходит с минимальной задержкой. Отслеживать статус выполнения заказа можно в личном кабинете, в реальном времени.﻿

Лайки начинают добавляются практически мгновенно на запись, фото, видео или комментарий которое вы укажите в поле ссылки. При оптовом заказе возможны скидки до 30% согласно тарифа скидочной системы. Страницы с которых ставятся лайки, преимущественно из России и стран СНГ.

Произведите заполнение формы заказа и его оплату. После чего заказ поступит в работу и будет выполнен в течении нескольких минут (в случаи большой очереди возможны задержки на крупные заказы). Услуга является абсолютно безопасной для личных страниц, групп и пабликов.',
                ],
                'price'             => 140,
                'old_price'         => 280,
                'multiplicity'      => 1000,
                'slug'              => 'vk-likes-fast-up',
                'status'            => DefaultStatusEnum::ON,
                'category'          => Category::query()->where('slug', 'vkontakte-likes')->first()->id,
                'sites'             => Site::query()->pluck('id'),
                'attributes'        => [
                    'min_count' => 100,
                    'max_count' => 5000,
                ],
            ],
            [
                'name'              => [
                    'en' => 'I LIKE - VK LIKES (INSTANT LAUNCH)',
                    'ru' => 'МНЕ НРАВИТСЯ – ЛАЙКИ ВК (МГНОВЕННЫЙ ЗАПУСК)',
                ],
                'short_description' => [
                    'en' => 'VK hearts. Likes are put by real users. Offers from server #5.',
                    'ru' => 'Сердечки VK. Лайки ставят реальные пользователи. Офферы с сервера #5.',
                ],
                'description'       => [
                    'en' => 'For 1 month up to 5000 likes, (limit up to 500 likes per day) * restrictions are set for the benefit of the client in order to avoid all sorts of write-offs and other problems. Completely safe. We do not ask for other data, only a link to add likes.

As quickly as possible. Everything is online. Hundreds of likes in a matter of hours. The highest quality. Our service is used by thousands of satisfied users. Promotion VKontakte for everyone without tasks and registration! Cheat likes on avu, photos or subscribers for your VKontakte page.

Do you lack popularity in social networks? You do not know how to quickly add likes to VK online? Do you want to raise your "rating" not only in your own eyes, but also to prove to everyone that you are really in demand?! You don\'t know how to get likes on VKontakte?! What forward to meet your dream - the site will help you get likes!',
                    'ru' => 'За 1 месяц до 5000 лайков, (лимит до 500 лайков в сутки) * ограничения установлены для пользы клиента, что бы избежать разного рода списаний и других проблем. Полностью безопасно. Мы не спрашиваем другие данные, только ссылку для добавления лайков.

Максимально быстро. Всё в режиме онлайн. Сотни лайков за считанные часы. Высочайшее качество. Нашим сервисом пользуются тысячи довольных пользователей. Раскрутка ВКонтакте для всех без заданий и регистрации! Накрутка лайков на аву, фото или подписчиков для твоей страницы ВКонтакте.

Вам не хватает популярности в социальных сетях? Вы не знаете, как сделать быструю добавить лайков вк онлайн? Вы хотите поднять свой "рейтинг" не только в своих глазах, но и доказать всем, что вы действительно востребованы?! Вы не знаете, как накрутить лайки вконтакте?! Что же вперед навстречу своей мечте - сайт поможет Вам получить лайки!',
                ],
                'price'             => 140,
                'old_price'         => 280,
                'multiplicity'      => 1000,
                'slug'              => 'vk-likes-offers-slow-1',
                'status'            => DefaultStatusEnum::ON,
                'category'          => Category::query()->where('slug', 'vkontakte-likes')->first()->id,
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
