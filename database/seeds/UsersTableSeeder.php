<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'alpha',
            'password' => bcrypt('omega'),
        ]);

        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
