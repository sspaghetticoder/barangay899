<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_tbl', function (Blueprint $table) {
            $table->id('request_id');
            $table->unsignedBigInteger('resident_id')->nullable();
            $table->foreign('resident_id')->references('resident_id')->on('resident_tbl')->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->char('suffix', 100)->nullable();
            $table->string('house_number');
            $table->string('street');
            $table->string('email_add');
            $table->string('contact_number');
            $table->string('purpose');
            $table->string('name_of_witness')->nullable();
            $table->string('request_status')->default('not done');
            $table->string('resident_status');
            $table->timestamp('confirmed_at')->nullable();
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
        Schema::dropIfExists('request_tbl');
    }
}
