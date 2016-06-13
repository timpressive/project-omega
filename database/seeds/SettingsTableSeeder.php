<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'term' => 'time',
            'value' => '3600000',
        ]);

        DB::table('settings')->insert([
            'term' => 'access-code',
            'value' => 'pr0j3c70m364',
        ]);

        DB::table('settings')->insert([
            'term' => 'pin-code',
            'value' => '0364',
        ]);

        DB::table('settings')->insert([
            'term' => 'override',
            'value' => 'exec protocol 66',
        ]);

        DB::table('settings')->insert([
            'term' => 'UID',
            'value' => '01020304050607',
        ]);
    }
}
