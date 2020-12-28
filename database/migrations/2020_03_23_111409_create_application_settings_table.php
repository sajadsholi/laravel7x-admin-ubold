<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id();
            $table->string('current_version');
            $table->tinyInteger('update_method')->comment('1 : do nothing | 2 : optional | 3 forced');
            $table->string('link');
            $table->string('direct_link')->nullable();
            $table->unsignedTinyInteger('device_id');
            $table->timestamps();

            $table->index('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('application_setting_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_setting_id');
            $table->string('locale')->index();
            $table->string('update_message');
            $table->timestamps();

            $table->unique(['application_setting_id', 'locale'], 'application_setting_id_locale_unique');
            $table->foreign('application_setting_id')->references('id')->on('application_settings')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_settings');
        Schema::dropIfExists('application_setting_translations');
    }
}
