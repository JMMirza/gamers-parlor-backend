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
            $table->dropColumn('start_date');
            $table->dateTime('start_time')->nullable()->after('fee');
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
            $table->date('start_date')->after('fee')->nullable();
            $table->dropColumn('start_time');
        });
    }
};
