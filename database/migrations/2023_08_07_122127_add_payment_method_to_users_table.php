<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('payment_method')->after('active_sub_key')->default(1)->comment('1=Online,2=Bank transfer');
            $table->tinyInteger('payment_method_verification')->after('active_sub_key')->default(0)->comment('1=verified,0=unverified');
            $table->double('amount')->after('active_sub_key')->default(0);
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
