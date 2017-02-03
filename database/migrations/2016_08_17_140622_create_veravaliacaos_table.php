<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeravaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('veravaliacaos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id');$table->integer('codigoavaliacao');$table->integer('statuslider');$table->integer('statusadmin');$table->integer('statusdiretoria');$table->text('obs');
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
        Schema::drop('veravaliacaos');
    }
}