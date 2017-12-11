<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_provinces', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('province_id');

            $table->unique(['user_id', 'province_id']);

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::table('user_provinces', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['province_id']);
        });

        Schema::dropIfExists('user_provinces');
    }
}
