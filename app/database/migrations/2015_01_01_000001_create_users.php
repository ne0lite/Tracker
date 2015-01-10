<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

    public function up() {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->timestamps();
            $table->rememberToken();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->boolean('admin')->default(false);
        });
    }

    public function down() {
        Schema::drop('users');
    }

}
