<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_privileges', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('privilege_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_privileges');
    }
}
