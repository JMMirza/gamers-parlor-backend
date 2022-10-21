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
        Schema::table('wager_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->after('id')->nullable();
            $table->foreign('game_id')->references('id')->on('games');
            $table->unsignedBigInteger('platform_id')->after('id')->nullable();
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->dropColumn('game_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wager_posts', function (Blueprint $table) {
            $table->dropForeign('wager_posts_game_id_foreign');
            $table->dropForeign('wager_posts_platform_id_foreign');
            $table->dropColumn('game_id');
            $table->dropColumn('platform_id');
        });
    }
};
