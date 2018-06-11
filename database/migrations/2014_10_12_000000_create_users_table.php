<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {   
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('1234'));
            $table->unsignedInteger('role_id')->default(\App\Role::TIENDA);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function($table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
        
    }
}
