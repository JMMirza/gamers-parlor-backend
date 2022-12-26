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
        Schema::create('ladder_post_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->unsignedBigInteger('losser_id')->nullable();
            $table->string('proof')->nullable();
            $table->string('result')->nullable();
            $table->unsignedBigInteger('ladder_post_id')->nullable();
            $table->foreign('ladder_post_id')->references('id')->on('ladder_posts');
            $table->unsignedBigInteger('ladder_post_enrollment_id')->nullable();
            $table->foreign('ladder_post_enrollment_id')->references('id')->on('ladder_post_enrollments');
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
        Schema::dropIfExists('ladder_post_results');
    }
};
