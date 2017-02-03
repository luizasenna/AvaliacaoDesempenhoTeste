<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVercargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('vercargos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id');$table->integer('codcargo');$table->string('nome');$table->integer('c1');$table->integer('c2');$table->integer('c3');$table->integer('c4');$table->integer('c5');$table->integer('c6');$table->integer('c7');$table->integer('c8');$table->integer('c9');$table->integer('c10');$table->integer('c11');$table->integer('c12');$table->integer('c12');$table->integer('c13');$table->integer('c14');$table->integer('c15');$table->string('created_at');$table->string('updated_at');
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
        Schema::drop('vercargos');
    }
}