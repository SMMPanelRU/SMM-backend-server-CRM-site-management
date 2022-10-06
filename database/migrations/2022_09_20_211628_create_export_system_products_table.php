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
        Schema::create('export_system_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('export_system_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('name')->index();
            $table->string('unique_id')->index();
            $table->boolean('status')->default(true)->index();
            $table->decimal('price')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_system_products');
    }
};
