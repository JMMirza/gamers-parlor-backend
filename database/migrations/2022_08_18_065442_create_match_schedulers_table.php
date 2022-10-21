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
        Schema::create('match_schedulers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team1_id');
            $table->foreign('team1_id')->references('id')->on('teams');
            $table->unsignedBigInteger('team2_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreign('team2_id')->references('id')->on('teams');
            $table->unsignedBigInteger('tournament_id')->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('match_schedulers');
    }
};
