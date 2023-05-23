<?php

use App\Enum\Attributes\AttributeTypesEnum;
use App\Models\Category;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $attribute = new \App\Models\Attribute();
        $attribute->name = [
            'en' => 'category icon',
            'ru' => 'иконка категории',
        ];
        $attribute->type = AttributeTypesEnum::Text;
        $attribute->slug = 'category_icon';
        $attribute->entity_type = Category::class;
        $attribute->is_searchable = false;
        $attribute->is_translatable = false;
        $attribute->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        (new \App\Models\Attribute())->where('slug', 'category_icon')->delete();
    }
};
