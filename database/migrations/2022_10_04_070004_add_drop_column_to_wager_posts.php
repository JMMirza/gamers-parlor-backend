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
            $table->dropForeign('wager_posts_status_id_foreign');
            $table->dropColumn('status_id');
            $table->string('status')->nullable()->after('terms_and_condition');
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
            $table->unsignedBigInteger('status_id')->nullable()->after('guest_id');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->dropColumn('status');
        });
    }
};
