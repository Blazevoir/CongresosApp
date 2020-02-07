<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPonencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userponencia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
          
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idponencia')->unsigned();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idponencia')->references('id')->on('ponencia');
            
            $table->unique(array('iduser', 'idponencia'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
