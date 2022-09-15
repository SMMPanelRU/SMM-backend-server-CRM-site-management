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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->index(['created_at', 'updated_at']);

            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('site_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('payment_system_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->decimal('amount');
            $table->decimal('discount')->default(0);
            $table->integer('status')->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
