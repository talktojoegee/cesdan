<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('exam_type_id');
            $table->double('total_amount')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0=New,1=Verified,2=discarded');
            $table->string('ref_code')->nullable();
            $table->bigInteger('actioned_by')->nullable();
            $table->dateTime('action_date')->nullable();
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
        Schema::dropIfExists('exam_registrations');
    }
}
