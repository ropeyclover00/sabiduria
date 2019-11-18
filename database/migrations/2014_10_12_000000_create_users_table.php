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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('rol')->default(1); //1 cliente, 2 admin

            $table->string('last_name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            //Datos de direccion del usuario
            $table->string('address')->nullable();
            $table->string('interior_number')->nullable();
            $table->string('exterior_number')->nullable();
            $table->string('suburb')->nullable();
            $table->string('between_streets')->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->unsignedBigInteger('city_id')->unsigned()->nullable();
            $table->unsignedBigInteger('state_id')->unsigned()->nullable();
            $table->unsignedBigInteger('image_id')->unsigned()->nullable();
            
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('state_id')
                  ->references('id')->on('states')
                  ->onDelete('cascade');

            $table->foreign('city_id')
                  ->references('id')->on('cities')
                  ->onDelete('cascade');

            $table->foreign('image_id')
                  ->references('id')->on('files')
                  ->onDelete('cascade');
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
