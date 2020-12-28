<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsOfServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_of_service', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('terms_of_service_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('terms_of_service_id');
            $table->string('locale')->index();
            $table->text('content');
            $table->timestamps();

            $table->unique(['terms_of_service_id', 'locale']);
            $table->foreign('terms_of_service_id')->references('id')->on('terms_of_service')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms_of_service');
        Schema::dropIfExists('terms_of_service_translations');
    }
}
