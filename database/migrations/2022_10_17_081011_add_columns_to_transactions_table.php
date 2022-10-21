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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->change();
            $table->string('full_name')->nullable()->change();
            $table->string('address_line_1')->nullable()->change();
            $table->string('admin_area_2')->nullable()->change();
            $table->string('postal_code')->nullable()->change();
            $table->string('country_code')->nullable()->change();
            $table->text('payment_json')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
