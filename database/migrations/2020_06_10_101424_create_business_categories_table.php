<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('priority')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index('parent_id');

            $table->foreign('parent_id')->references('id')->on('business_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('business_category_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_category_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('link');
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->unique(['business_category_id', 'locale', 'link'], 'business_category_id_locale_link_unique');

            $table->index('business_category_id');

            $table->foreign('business_category_id')->references('id')->on('business_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_categories');
        Schema::dropIfExists('business_category_translations');
    }
}
