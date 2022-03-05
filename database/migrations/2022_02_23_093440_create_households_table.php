<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseholdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_tbl', function (Blueprint $table) {
            $table->id('household_id');
            $table->unsignedBigInteger('resident_id');
            $table->foreign('resident_id')->references('resident_id')->on('resident_tbl');
            $table->string('household_no');
            $table->string('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('household_tbl');
    }
}
