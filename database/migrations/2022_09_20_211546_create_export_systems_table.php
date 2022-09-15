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
        Schema::create('export_systems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('name');
            $table->boolean('status')->default(false)->index();

            $table->string('slug')->index();
            $table->string('logo')->nullable();

            $table->string('handler')->index()->nullable();

            $table->json('settings')->nullable();

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
        Schema::dropIfExists('export_systems');
    }
};
