<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_tbl', function (Blueprint $table) {
            $table->id('resident_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->char('suffix', 100)->nullable();
            $table->string('alias')->nullable();
            $table->string('sex');
            $table->date('birth_date');
            $table->string('place_of_birth');
            $table->string('citizenship');
            $table->string('civil_status');
            $table->string('religion');
            $table->string('blood_type');
            $table->string('pwd');
            $table->unsignedInteger('years_of_residence')->nullable();
            $table->string('member_4ps');
            $table->string('voter_status');
            $table->string('identified_as');
            $table->string('email_add');
            $table->string('contact_no');
            $table->string('emp_stat');
            $table->string('occupation')->nullable();
            $table->string('emp_name')->nullable();
            $table->unsignedInteger('monthly_income')->nullable();
            $table->string('floor_no')->nullable();
            $table->string('block_no')->nullable();
            $table->string('street_name');
            $table->string('family_relation');
            $table->string('sss_no')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('gsis_no')->nullable();
            $table->string('pagibig_no')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('resident_status');
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
        Schema::dropIfExists('resident_tbl');
    }
}
