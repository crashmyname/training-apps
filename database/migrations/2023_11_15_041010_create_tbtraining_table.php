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
        Schema::create('tbtraining', function (Blueprint $table) {
            $table->id('train_id');
            $table->bigInteger('schedule_id');
            $table->string('nik');
            $table->string('name');
            $table->string('section');
            $table->string('matepl');
            $table->string('questfeedback');
            $table->string('evaluation');
            $table->string('history_gol');
            $table->string('created_by');
            $table->string('modify_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbtraining');
    }
};
