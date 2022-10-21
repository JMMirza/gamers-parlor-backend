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
        Schema::create('tournament_level_match_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->unsignedBigInteger('tournament_level_id');
            $table->foreign('tournament_level_id')->references('id')->on('tournament_levels');
            $table->unsignedBigInteger('tournament_level_match_id');
            $table->foreign('tournament_level_match_id')->references('id')->on('tournament_level_matches');
            $table->unsignedBigInteger('winner_team_id');
            $table->foreign('winner_team_id')->references('id')->on('teams');
            $table->string('result');
            $table->string('winning_proof');
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
        Schema::dropIfExists('tournament_level_match_results');
    }
};
