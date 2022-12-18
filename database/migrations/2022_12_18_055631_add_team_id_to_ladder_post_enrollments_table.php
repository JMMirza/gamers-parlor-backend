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
        Schema::table('ladder_post_enrollments', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable()->after('ladder_post_id');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->dropForeign('ladder_post_enrollments_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ladder_post_enrollments', function (Blueprint $table) {
            $table->dropForeign('ladder_post_enrollments_team_id_foreign');
            $table->dropColumn('team_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};
