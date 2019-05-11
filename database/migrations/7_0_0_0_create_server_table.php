<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Servers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('server_id');
            $table->string('server_name')->unique();
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('game_id')->on('games')->onDelete('cascade');
            $table->string('server_label');
            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')->references('host_id')->on('lgsm_hosts')->onDelete('cascade');
            $table->integer('credential_id')->unsigned();
            $table->foreign('credential_id')->references('credential_id')->on('server_credentials')->onDelete('cascade');
            $table->timestamps();
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
        Schema::dropIfExists('Servers');
    }
}
