<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('province_id');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('name', 127)->index();

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('province_id')
                ->references('id')->on('provinces')
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
        Schema::table('counties', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
        });

        Schema::dropIfExists('counties');
    }
}
