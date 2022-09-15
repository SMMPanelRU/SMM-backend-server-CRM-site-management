<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('name');
            $table->integer('type')->index();
            $table->string('slug')->index();
            $table->string('entity_type')->index();
            $table->boolean('is_searchable')->index();
            $table->boolean('is_translatable')->index();

            $table->string('name_en')->storedAs('JSON_UNQUOTE(name->>"$.en")')->index();
            $table->string('name_ru')->storedAs('JSON_UNQUOTE(name->>"$.ru")')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
};
