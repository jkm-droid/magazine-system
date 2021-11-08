<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('country');
            $table->string('email')->unique();
            $table->string('subscription_plan');
            $table->float('amount');
            $table->string('merchant_id')->nullable();
            $table->string('account_number')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->binary('profile')->default('default.profile.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
