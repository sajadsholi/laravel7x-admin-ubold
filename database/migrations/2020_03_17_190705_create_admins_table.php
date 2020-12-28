<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('contact_number')->nullable();
            $table->rememberToken();
            $table->boolean('isActive')->default(1);
            $table->integer('lockout_time')->default(20);
            $table->unsignedBigInteger('role_id')->nullable();
            $table->timestamps();

            $table->index('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('SET NULL')->onUpdate('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
