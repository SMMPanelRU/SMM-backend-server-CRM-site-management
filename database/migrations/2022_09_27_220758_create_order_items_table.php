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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('order_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('product_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->integer('count');

            $table->integer('done_count')->nullable();

            $table->foreignId('export_system_product_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->integer('export_system_status')->nullable();

            $table->string('export_system_status_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
