nice<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('nice_name');
            $table->string('name');
            $table->string('sex');
            $table->string('wexin_openid')->unique()->nullable();
            $table->string('code')->unique();
            $table->string('phone');
            $table->string('pic')->nullable();
            $table->string('school')->index();
            $table->string('grade')->nullable();
            $table->string('class')->nullable();
            $table->Integer('type')->index();
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
