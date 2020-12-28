<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->string('direction')->default('ltr')->after('language');
            $table->boolean('is_default')->default(0)->after('direction');
            $table->unsignedBigInteger('priority')->default(0)->after('is_default');
            $table->softDeletes()->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('direction');
            $table->dropColumn('is_default');
            $table->dropColumn('priority');
            $table->dropColumn('deleted_at');
        });
    }
}
