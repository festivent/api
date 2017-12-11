<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('name', 127)->index();
            $table->text('address');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->text('hint')->nullable();
            $table->unsignedInteger('province_id');
            $table->unsignedInteger('county_id');
            $table->timestamps();

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('province_id')
                ->references('id')->on('provinces')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('county_id')
                ->references('id')->on('counties')
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
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropForeign(['county_id']);
        });

        Schema::dropIfExists('addresses');
    }
}
