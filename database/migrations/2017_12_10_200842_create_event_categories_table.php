<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_categories', function (Blueprint $table) {
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('category_id');

            $table->unique(['event_id', 'category_id']);

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_categories', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('event_categories');
    }
}
