<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('attribute_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->json('value')->nullable();

            $table->string('value_en')->storedAs('JSON_UNQUOTE(value->>"$.en")')->index();
            $table->string('value_ru')->storedAs('JSON_UNQUOTE(value->>"$.ru")')->index();

            $table->json('text_value')->nullable();

            $table->string('non_translatable_value')->nullable()->index();

            $table->foreignId('attribute_predefined_value_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

//            $table->longText('text_value_en')->storedAs('JSON_UNQUOTE(text_value->>"$.en")');
//            $table->longText('text_value_ru')->storedAs('JSON_UNQUOTE(text_value->>"$.ru")');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_values');
    }
};
