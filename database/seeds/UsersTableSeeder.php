<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'username' => '000000',
            'email' => 'root@gateway.gramedia-majalah.com',
            'password' => Illuminate\Support\Facades\Hash::make('password'),
        ]);
    }

}
