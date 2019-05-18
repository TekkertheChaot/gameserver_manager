<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServercredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_credentials', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('credential_id');
            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')->references('host_id')->on('lgsm_hosts')->onDelete('cascade');
            $table->string('user');
            $table->string('password');
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
        Schema::dropIfExists('server_credentials');
    }
}
