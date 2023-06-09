<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoituresTable extends Migration
{
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('marque');
            $table->string('modele');
            $table->string('confort');
            $table->integer('nombre_de_place');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('voitures');
    }
};
