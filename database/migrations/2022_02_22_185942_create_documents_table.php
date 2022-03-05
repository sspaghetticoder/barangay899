<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_tbl', function (Blueprint $table) {
            $table->id('document_id');
            $table->unsignedBigInteger('request_id');
            $table->foreign('request_id')->references('request_id')->on('request_tbl')->onDelete('cascade');
            $table->integer('amount')->default(0);
            $table->string('or_no')->nullable();
            $table->char('document_type', 1);
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
        Schema::dropIfExists('document_tbl');
    }
}
