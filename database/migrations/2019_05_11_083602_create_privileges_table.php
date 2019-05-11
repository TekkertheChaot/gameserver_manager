<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->integer('userid')->nullable();
            $table->integer('groupid')->nullable();
            $table->integer('serverid');
            $table->boolean('lgsmstart');
            $table->boolean('lgsmrestart');
            $table->boolean('lgsmstop');
            $table->boolean('lgsmupdate');
            $table->boolean('lgsmstatus');
            $table->boolean('viewindash');
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
        Schema::dropIfExists('privileges');
    }
}
