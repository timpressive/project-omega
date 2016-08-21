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
            'term' => 'console-pass',
            'value' => 'password',
        ]);

        DB::table('settings')->insert([
            'term' => 'console-pass-default',
            'value' => 'password',
        ]);

        DB::table('settings')->insert([
            'term' => 'console-command',
            'value' => 'exec protocol 66',
        ]);

        DB::table('settings')->insert([
            'term' => 'console-command-default',
            'value' => 'exec protocol 66',
        ]);

        DB::table('settings')->insert([
            'term' => 'memo',
            'value' => "omega is uit het labo verdwenen. ik VermOEd echteR dat DIe mannen in maaTpak daar iets mee te maken hebben. het volledige onderzoek is gewist, alsof het nooit bestaan heeft, maar dat is niet mijn probleem.\n\nMijn COntract is hier bijna ten einde. dus ik word sowieso betaald. ze koMen Mij zo dAdelijk haleN. DOmme fouten zijn hier zeker gemaakt dat is dUIdelijk, me dunkT.\n\nook al heb ik net mijn carrière geEXECuteerd, ik blijf PROTOCOL volgen. ik ben bijna '66', mijn pensioen is toch in zicht.",
        ]);

        DB::table('settings')->insert([
            'term' => 'memo-default',
            'value' => "omega is uit het labo verdwenen. ik VermOEd echteR dat DIe mannen in maaTpak daar iets mee te maken hebben. het volledige onderzoek is gewist, alsof het nooit bestaan heeft, maar dat is niet mijn probleem.\n\nMijn COntract is hier bijna ten einde. dus ik word sowieso betaald. ze koMen Mij zo dAdelijk haleN. DOmme fouten zijn hier zeker gemaakt dat is dUIdelijk, me dunkT.\n\nook al heb ik net mijn carrière geEXECuteerd, ik blijf PROTOCOL volgen. ik ben bijna '66', mijn pensioen is toch in zicht.",
        ]);
    }
}
