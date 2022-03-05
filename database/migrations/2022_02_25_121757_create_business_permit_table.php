<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_permit_tbl', function (Blueprint $table) {
            $table->id('business_permit_id');
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('document_id')->on('document_tbl')->onDelete('cascade');
            $table->string('business_name');
            $table->string('business_nature');
            $table->string('business_owner');
            $table->string('owners_add')->nullable();
            $table->string('business_add');
            $table->string('business_phone')->nullable();
            $table->date('date_applied')->default(now());
            $table->date('date_expiration')->nullable();
            $table->string('permit_status')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('business_permit_tbl');
    }
}
