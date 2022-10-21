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
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->after('avatar')->nullable();
            $table->integer('balance')->after('date_of_birth')->default(0);
            $table->unsignedBigInteger('status_id')->after('balance')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropColumn('balance');
            $table->dropForeign('users_status_id_foreign');
            $table->dropColumn('status_id');
            $table->dropColumn('deleted_at');
        });
    }
};
