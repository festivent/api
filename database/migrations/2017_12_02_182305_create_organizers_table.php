<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizers', function (Blueprint $table) {
            $table->increments('id');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('name', 127)->index();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('telephone', 31)->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('email', 127)->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::table('organizers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('organizers');
    }
}
