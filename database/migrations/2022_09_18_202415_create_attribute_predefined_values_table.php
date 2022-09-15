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
        Schema::create('attribute_predefined_values', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('attribute_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->json('value');

            $table->string('value_en')->storedAs('JSON_UNQUOTE(value->>"$.en")')->index();
            $table->string('value_ru')->storedAs('JSON_UNQUOTE(value->>"$.ru")')->index();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_predefined_values');
    }
};
