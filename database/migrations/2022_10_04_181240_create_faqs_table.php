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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('question');
            $table->json('answer');
            $table->boolean('status')->default(false)->index();

            $table->string('question_en')->storedAs('JSON_UNQUOTE(question->>"$.en")')->index();
            $table->string('question_ru')->storedAs('JSON_UNQUOTE(question->>"$.ru")')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
