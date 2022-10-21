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
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropForeign('tournaments_status_id_foreign');
            $table->dropColumn('status_id');
            $table->string('status')->nullable()->after('terms_and_condition');
            $table->unsignedBigInteger('winner_team_id')->nullable()->after('terms_and_condition');
            $table->foreign('winner_team_id')->references('id')->on('teams');
            $table->integer('request_received')->after('number_of_request')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->after('terms_and_condition');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->dropColumn('status');
            $table->dropColumn('request_received');
            $table->dropForeign('tournaments_winner_team_id_foreign');
            $table->dropColumn('winner_team_id');
        });
    }
};
