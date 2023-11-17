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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->string('name_training');
            $table->string('name_trainer');
            $table->string('section');
            $table->date('plan');
            $table->date('replan1')->nullable();
            $table->date('replan2')->nullable();
            $table->date('replan3')->nullable();
            $table->date('actual')->nullable();
            $table->integer('participants');
            $table->string('pic');
            $table->date('duedate');
            $table->string('statusmonitor');
            $table->string('desc');
            $table->string('created_by')->nullable();
            $table->string('modify_by')->nullable();
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
        Schema::dropIfExists('schedule');
    }
};
