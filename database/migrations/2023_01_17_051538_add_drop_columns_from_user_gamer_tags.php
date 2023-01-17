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
        Schema::table('user_gamer_tags', function (Blueprint $table) {
            $table->dropForeign('user_gamer_tags_gamer_tag_id_foreign');
            $table->dropColumn('gamer_tag_id');
            $table->unsignedBigInteger('platform_id')->nullable()->after('user_id');
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->string('gamer_tag')->nullable()->after('platform_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_gamer_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('gamer_tag_id')->nullable();
            $table->foreign('gamer_tag_id')->references('id')->on('gamer_tags');
            $table->dropForeign('user_gamer_tags_platform_id_foreign');
            $table->dropColumn('platform_id');
            $table->dropColumn('gamer_tag');
        });
    }
};
