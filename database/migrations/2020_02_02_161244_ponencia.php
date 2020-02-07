<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ponencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponencia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
          
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->string('titulo',120)->unique();
            $table->string('video',255)->unique();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('iduser')->references('id')->on('users')->onDelete('restrict');
            
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
