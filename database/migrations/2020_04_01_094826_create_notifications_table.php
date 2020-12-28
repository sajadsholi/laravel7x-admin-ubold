<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->json('token')->nullable();
            $table->json('template');
            $table->string('type');
            $table->string('receiver')->nullable();
            $table->boolean('isAll')->default(0);
            $table->unsignedBigInteger('current_id')->default(0);
            $table->unsignedBigInteger('last_id')->default(0);
            $table->boolean('isDone')->default(0);
            $table->morphs('notificationable');
            $table->unsignedTinyInteger('device_id');
            $table->timestamps();

            $table->index('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
