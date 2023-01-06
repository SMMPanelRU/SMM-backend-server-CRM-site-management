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
        Schema::create('user_balance_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_balance_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('entity_type')->index();
            $table->unsignedBigInteger('entity_id')->index();

            $table->decimal('amount', 20);
            $table->decimal('balance', 20);
            $table->decimal('old_balance', 20);

            $table->string('description')->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_balance_histories');
    }
};
