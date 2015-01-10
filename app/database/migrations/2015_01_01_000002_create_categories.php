<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategories extends Migration {

    public function up() {
        Schema::create('categories', function($table) {
            $table->increments('id');
            $table->string('name');
        });
    }

    public function down() {
        Schema::drop('categories');
    }

}
