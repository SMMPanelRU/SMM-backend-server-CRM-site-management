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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('name');
            $table->string('code')->index();
            $table->string('icon');
            $table->decimal('course')->nullable();

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
        Schema::dropIfExists('currencies');
    }
};
