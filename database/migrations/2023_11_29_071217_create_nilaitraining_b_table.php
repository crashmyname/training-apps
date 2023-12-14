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
        Schema::create('nilaitraining_b', function (Blueprint $table) {
            $table->id('score_b_id');
            $table->bigInteger('schedule_id');
            $table->integer('tes');
            $table->string('created_by');
            $table->string('modify_by');
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
        Schema::dropIfExists('nilaitraining_b');
    }
};
