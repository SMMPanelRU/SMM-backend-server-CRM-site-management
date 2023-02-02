<?php

namespace Database\Seeders;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Enum\DefaultStatusEnum;
use App\Enum\EnumTrait;
use App\Enum\Tickets\TicketStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class LangSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        LanguageLine::query()->truncate();;

        $this->texts();
        $this->entities();
        $this->enums();

    }

    private function texts() {
        $texts = [
            'pagination'    => [
                'show'    => ['en' => 'show', 'ru' => 'показывать'],
                'entries' => ['en' => 'entries', 'ru' => 'записей'],
                'showing' => ['en' => 'showing', 'ru' => 'отображается'],
                'of'      => ['en' => 'of', 'ru' => 'из'],
            ],
            'fields'        => [
                'name'              => ['en' => 'name', 'ru' => 'название'],
                'slug'              => ['en' => 'slug', 'ru' => 'код'],
                'sort'              => ['en' => 'sort', 'ru' => 'сортировка'],
                'logo'              => ['en' => 'logo', 'ru' => 'лого'],
                'parent'            => ['en' => 'parent', 'ru' => 'родитель'],
                'choose'            => ['en' => 'choose', 'ru' => 'выбрать'],
                'handler'           => ['en' => 'handler', 'ru' => 'обработчик'],
                'status'            => ['en' => 'status', 'ru' => 'статус'],
                'short_description' => ['en' => 'short description', 'ru' => 'краткое описание'],
                'description'       => ['en' => 'description', 'ru' => 'описание'],
                'price'             => ['en' => 'price', 'ru' => 'цена'],
                'old_price'         => ['en' => 'old price', 'ru' => 'старая цена'],
                'multiplicity'      => ['en' => 'multiplicity', 'ru' => 'кратность'],
            ],
            'forms'         => [
                'save'                  => ['en' => 'save', 'ru' => 'сохранить'],
                'create'                => ['en' => 'create', 'ru' => 'создать'],
                'delete'                => ['en' => 'delete', 'ru' => 'удалить'],
                'export'                => ['en' => 'export', 'ru' => 'экспорт'],
                'export_system'         => ['en' => 'export system', 'ru' => 'система экспорта'],
                'export_system_product' => ['en' => 'export products', 'ru' => 'услуги экспорта'],
                'attributes'            => ['en' => 'attributes', 'ru' => 'свойства'],
                'discounts'             => ['en' => 'discounts', 'ru' => 'скидки'],
                'make_admin'            => ['en' => 'make admin', 'ru' => 'сделать админом'],
                'remove_admin'          => ['en' => 'remove admin', 'ru' => 'убрать админа'],
            ],
            'export_system' => [
                'Api_key' => ['en' => 'api key', 'ru' => 'api ключ'],
                'balance' => ['en' => 'balance', 'ru' => 'Баланс'],
            ],
            'payment_system' => [
                'disabled' => ['en' => 'Payment system disabled', 'ru' => 'Платежная система отключена'],
            ],
            'text'          => [
                'products'       => ['en' => 'products', 'ru' => 'товары'],
                'settings'       => ['en' => 'settings', 'ru' => 'настройки'],
                'categories'     => ['en' => 'categories', 'ru' => 'категории'],
                'attributes'     => ['en' => 'attributes', 'ru' => 'аттрибуты'],
                'sites'          => ['en' => 'sites', 'ru' => 'сайты'],
                'pages'          => ['en' => 'pages', 'ru' => 'страницы'],
                'faq'            => ['en' => 'faq', 'ru' => 'faq'],
                'export_systems' => ['en' => 'export systems', 'ru' => 'системы экспорта'],
                'orders'         => ['en' => 'orders', 'ru' => 'заказы'],
                'users'          => ['en' => 'users', 'ru' => 'пользователи'],
                'tickets'        => ['en' => 'tickets', 'ru' => 'тикеты'],
                'count'          => ['en' => 'count', 'ru' => 'количество'],
                'discount'       => ['en' => 'discount', 'ru' => 'скидка'],
                'add'            => ['en' => 'add', 'ru' => 'добавить'],
                'administrators' => ['en' => 'administrators', 'ru' => 'администраторы'],
            ],
        ];

        foreach ($texts as $group => $values) {
            foreach ($values as $key => $value) {
                LanguageLine::query()->updateOrCreate(
                    [
                        'group' => $group,
                        'key'   => $key,
                    ],
                    ['text' => $value]
                );
            }
        }
    }

    private function entities() {

        $entities = [
            Category::class => ['en' => 'category', 'ru' => 'категория'],
            Site::class     => ['en' => 'site', 'ru' => 'сайт'],
            Product::class  => ['en' => 'product', 'ru' => 'товар'],
        ];

        foreach ($entities as $key => $value) {
            LanguageLine::query()->updateOrCreate(
                [
                    'group' => 'entities',
                    'key'   => $key,
                ],
                ['text' => $value]
            );

        }

    }

    private function enums() {

        $enums = [
            DefaultStatusEnum::class . '.' . DefaultStatusEnum::OFF->name     => ['en' => 'OFF', 'ru' => 'Выкл'],
            DefaultStatusEnum::class . '.' . DefaultStatusEnum::ON->name      => ['en' => 'ON', 'ru' => 'Вкл'],
            TicketStatusEnum::class . '.' . TicketStatusEnum::New->name       => ['en' => 'new', 'ru' => 'новый'],
            TicketStatusEnum::class . '.' . TicketStatusEnum::WaitAdmin->name => ['en' => 'wait admin reply', 'ru' => 'ожидает ответ администратора'],
            TicketStatusEnum::class . '.' . TicketStatusEnum::WaitUser->name  => ['en' => 'wait user reply', 'ru' => 'ожидает ответ пользователя'],
            TicketStatusEnum::class . '.' . TicketStatusEnum::Working->name   => ['en' => 'working', 'ru' => 'в работе'],
            TicketStatusEnum::class . '.' . TicketStatusEnum::Closed->name    => ['en' => 'closed', 'ru' => 'закрыт'],
        ];

        foreach ($enums as $key => $value) {
            LanguageLine::query()->updateOrCreate(
                [
                    'group' => 'enums',
                    'key'   => $key,
                ],
                ['text' => $value]
            );

        }

    }
}
