<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('counters', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->integer('merchant_id')->unsigned();
        //     $table->timestamps();
        // });

        // Schema::table('counters', function (Blueprint $table) {
        //     $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('counters', function (Blueprint $table) {
        //     $table->dropForeign(['merchant_id']);
        // });

        // Schema::dropIfExists('counters');
    }
}
