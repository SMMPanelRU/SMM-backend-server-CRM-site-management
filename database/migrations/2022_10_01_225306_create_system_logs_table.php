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
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->index(['created_at', 'updated_at']);

            $table->string('class')->nullable()->index();
            $table->string('method')->nullable()->index();
            $table->string('index')->nullable()->index();
            $table->integer('type')->nullable()->index();
            $table->string('message')->nullable()->index();
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
        Schema::dropIfExists('system_logs');
    }
};
