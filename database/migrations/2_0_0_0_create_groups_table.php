<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('group_id');
            $table->string('group_name')->unique();
        });

        DB::table('Groups')->insert(
            array(
                'group_id' => 1,
                'group_name' => 'admins'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('Groups');
    }
}
