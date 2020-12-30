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
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('fullname')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('mobile')->unique()->nullable();
            $table->string('introducer_mobile')->nullable();
            $table->string('verify_code')->nullable();
            $table->unsignedBigInteger('verify_counter')->default(0);
            $table->boolean('verify_is_expire')->default(0);
            $table->dateTime('verify_last_date')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean("password_must_be_change")->default(0);
            $table->dateTime('born_at')->nullable();
            $table->string('timezone')->nullable();
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
