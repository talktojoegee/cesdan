<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->string('marital_status')->nullable();
           $table->date('birth_date')->nullable();
           $table->integer('nationality')->nullable();
           $table->integer('state_origin')->nullable();
           $table->integer('lga')->nullable();
           $table->string('contact_address')->nullable();
           $table->string('contact_city')->nullable();
           $table->integer('contact_state')->nullable();
           $table->integer('contact_country')->nullable();
           $table->integer('geo_zone')->nullable();
           $table->integer('heard_ican')->nullable();
           $table->string('residential_address')->nullable();
           $table->string('residential_city')->nullable();
           $table->integer('residential_state')->nullable();
           $table->string('residential_telephone')->nullable();
           $table->string('office_address')->nullable();
           $table->string('office_city')->nullable();
           $table->integer('office_state')->nullable();
           $table->string('office_telephone')->nullable();
           $table->string('primary_school')->nullable();
           $table->string('primary_graduate_year')->nullable();
           $table->integer('primary_school_country')->nullable();
           $table->string('college_name')->nullable();
           $table->string('secondary_graduate_year')->nullable();
           $table->integer('secondary_school_country')->nullable();
           $table->string('graduate_institution')->nullable();
           $table->integer('graduate_qualification')->nullable();
           $table->integer('graduate_discipline')->nullable();
           $table->string('graduate_graduation_year')->nullable();
           $table->integer('graduate_institution_country')->nullable();
           $table->string('post_graduate_institution')->nullable();
           $table->integer('post_graduate_qualification')->nullable();
           $table->integer('post_graduate_discipline')->nullable();
           $table->string('post_graduate_year')->nullable();
           $table->integer('post_graduate_institution_country')->nullable();
           $table->integer('professional_qualification')->nullable();
           $table->string('professional_qualification_year')->nullable();
           $table->string('second_professional_qualification')->nullable();
           $table->string('second_professional_qualification_year')->nullable();
           $table->string('examination_no')->nullable();
           $table->string('examination_year')->nullable();
           $table->string('company_name')->nullable();
           $table->string('department')->nullable();
           $table->string('position')->nullable();
           $table->string('sector_one')->nullable();
           $table->integer('sector_two')->nullable();
           $table->string('referee_name')->nullable();
           $table->string('referee_membership_no')->nullable();
           $table->string('referee_mobile_no')->nullable();
           $table->integer('sponsoring_district')->nullable();

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
            //
        });
    }
}
