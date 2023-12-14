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
        Schema::create('nilaitraining_a', function (Blueprint $table) {
            $table->id('score_a_id');
            $table->bigInteger('schedule_id');
            $table->integer('pemahaman');
            $table->integer('skill');
            $table->integer('kinerja');
            $table->integer('implementasi');
            $table->integer('improvement');
            $table->integer('mengajarkan');
            $table->string('kesimpulan');
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
        Schema::dropIfExists('nilaitraining_a');
    }
};
