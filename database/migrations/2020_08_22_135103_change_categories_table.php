<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->bigInteger('parent_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // 既にテーブルの対象カラムにNULLを登録しているならば必要
            // DB::statement('UPDATE `categories` SET `parent_id` = "" WHERE `parent_id` IS NULL');
            $table->bigInteger('parent_id')->nullable(false)->change();
        });
    }
}
