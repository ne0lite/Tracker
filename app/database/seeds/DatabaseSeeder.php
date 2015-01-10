<?php

class DatabaseSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->call('CategoryTableSeeder');
    }

}

class UserTableSeeder extends Seeder {

    public function run() {
        $user = new User();
        $user->name = "Administrator";
        $user->email = 'admin@tracker.dev';
        $user->admin = true;
        $user->password = Hash::make('admin');
        $user->save();
    }

}

class CategoryTableSeeder extends Seeder {

    public function run() {
        Category::create(array('name' => 'Movies'));
        Category::create(array('name' => 'Books'));
        Category::create(array('name' => 'Music'));
        Category::create(array('name' => 'Episodes'));
    }

}