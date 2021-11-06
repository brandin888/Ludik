<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->integer('idDisfraz');
            $table->string('Apellido');
            $table->string('DNI');
            $table->string('Celular');
            $table->integer('Acepto');
           $table->integer('idProvincia');
            $table->string('idDepartamento');
            $table->string('Correo')->unique();
            $table->timestamp('Fecha Nacimiento ')->nullable();
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
