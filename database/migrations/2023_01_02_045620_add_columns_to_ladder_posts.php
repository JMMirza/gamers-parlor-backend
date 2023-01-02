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
        Schema::table('ladder_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('challenger_team_id')->nullable();
            $table->foreign('challenger_team_id')->references('id')->on('teams');

            $table->unsignedBigInteger('winner_team_id')->nullable();
            $table->foreign('winner_team_id')->references('id')->on('teams');

            $table->unsignedBigInteger('losser_team_id')->nullable();
            $table->foreign('losser_team_id')->references('id')->on('teams');

            $table->string('wining_proof')->nullable();
            $table->string('result_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ladder_posts', function (Blueprint $table) {
            $table->dropForeign('ladder_posts_challenger_team_id_foreign');
            $table->dropColumn('challenger_team_id');
            $table->dropForeign('ladder_posts_winner_team_id_foreign');
            $table->dropColumn('winner_team_id');
            $table->dropForeign('ladder_posts_losser_team_id_foreign');
            $table->dropColumn('losser_team_id');
            $table->dropColumn('wining_proof');
        });
    }
};
