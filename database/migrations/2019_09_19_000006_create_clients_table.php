<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('document')->nullable();

            $table->string('name')->nullable();

            $table->integer('age')->nullable();

            $table->string('gender')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->string('city')->nullable();

            $table->string('pathology')->nullable();

            $table->timestamps();

            $table->softDeletes();
            
        });
    }
}
