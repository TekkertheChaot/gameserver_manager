<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Group_Privileges', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->Integer('group_id')->unsigned();
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
            $table->Integer('server_id')->unsigned();
            $table->foreign('server_id')->references('server_id')->on('servers')->onDelete('cascade');
            $table->boolean('lgsm_start');
            $table->boolean('lgsm_restart');
            $table->boolean('lgsm_stop');
            $table->boolean('lgsm_update');
            $table->boolean('lgsm_status');
            $table->boolean('view_in_dash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('Group_Privileges');
    }
}
