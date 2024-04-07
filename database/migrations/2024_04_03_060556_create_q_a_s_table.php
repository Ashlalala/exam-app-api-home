<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams');
            $table->string('type')->default('full'); //'full', 'part'
            $table->longText('question');
            $table->longText('ans_r');
            $table->longText('ans_1')->nullable();
            $table->longText('ans_2')->nullable();
            $table->longText('ans_3')->nullable();
            $table->longText('ans_4')->nullable();
            $table->longText('ans_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_s');
    }
}
