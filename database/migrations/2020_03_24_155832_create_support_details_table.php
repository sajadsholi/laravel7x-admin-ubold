<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_id');
            $table->unsignedBigInteger('admin_id')->nullable()->comment('NULL : is user');
            $table->text('message');
            $table->timestamps();

            $table->index('support_id');
            $table->index('admin_id');
            $table->foreign('support_id')->references('id')->on('supports')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_details');
    }
}
