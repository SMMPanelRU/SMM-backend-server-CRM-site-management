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
        Schema::create('entity_models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('entity_model_type')->index();
            $table->unsignedBigInteger('entity_model_id')->index();

            $table->foreignId('site_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_sites');
    }
};
