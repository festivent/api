<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('key', 31)->nullable()->unique();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('title', 127)->index();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->text('description')->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('image', 63)->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->timestamp('started_at')->index();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->timestamp('ended_at')->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->unsignedDecimal('price', 5, 2)->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('price_type', 7)->default('tl');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->unsignedSmallInteger('capacity')->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->unsignedSmallInteger('age_limit')->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->unsignedInteger('user_id')->nullable();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->unsignedInteger('organizer_id')->nullable();
            $table->unsignedInteger('address_id');
            $table->timestamps();

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('organizer_id')
                ->references('id')->on('organizers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('address_id')
                ->references('id')->on('addresses')
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['organizer_id']);
            $table->dropForeign(['address_id']);
        });

        Schema::dropIfExists('events');
    }
}
