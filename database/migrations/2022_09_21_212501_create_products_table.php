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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('name');
            $table->json('short_description');
            $table->json('description');

            $table->string('slug')->index();
            $table->string('logo')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('multiplicity')->default(1);

            $table->foreignId('export_system_product_id')->nullable()->constrained()->nullOnDelete();

            $table->boolean('status')->default(false)->index();

            $table->string('name_en')->storedAs('JSON_UNQUOTE(name->>"$.en")')->index();
            $table->string('name_ru')->storedAs('JSON_UNQUOTE(name->>"$.ru")')->index();

            $table->string('short_description_en')->storedAs('JSON_UNQUOTE(short_description->>"$.en")')->index();
            $table->string('short_description_ru')->storedAs('JSON_UNQUOTE(short_description->>"$.ru")')->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
