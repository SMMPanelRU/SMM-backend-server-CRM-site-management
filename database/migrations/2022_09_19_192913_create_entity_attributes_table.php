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
        Schema::create('entity_attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('entity_attribute_type')->index();
            $table->unsignedBigInteger('entity_attribute_id')->index();

            $table->foreignId('attribute_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('attribute_value_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_attributes');
    }
};
