<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLgsmhostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lgsm_hosts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('host_id');
            $table->string('ip_adress');
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
        Schema::dropIfExists('lgsm_hosts');
    }
}
