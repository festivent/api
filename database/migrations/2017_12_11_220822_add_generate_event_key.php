<?php

use Illuminate\Database\Migrations\Migration;

class AddGenerateEventKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->execStatement('create_generate_event_key_function.sql');
        $this->execStatement('create_generate_event_key_trigger.sql');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->execStatement('drop_generate_event_key_trigger.sql');
        $this->execStatement('drop_generate_event_key_function.sql');
    }

    /**
     * Exec statement.
     *
     * @param $file
     */
    protected function execStatement($file)
    {
        if (app()->environment() == 'testing') {
            return;
        }

        $filename = database_path(
            'migrations/statements/' . $file
        );

        DB::statement(
            file_get_contents($filename)
        );
    }
}
