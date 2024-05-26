<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([

                                        'id' => 1,
                                       'name' => 'Beatrice',
                                       'email' => 'info@beatriceweb.it',
                                       'password' => bcrypt('silvestro1'),
                                       'is_admin' => true,
                                   ]);
        DB::table('users')->insert([
                                       [
                                           'id' => 2,
                                           'name' => 'Lucian',
                                           'email' => 'lucian@beatriceweb.com',
                                           'password' => bcrypt('ded'),
                                           'race' => 'Elfo dei boschi',
                                           'class' => 'Ranger',
                                           'level' => 1,
                                           'alignment' => 'CG',
                                           'mandatory' => false,
                                           'spells' => 0,
                                       ],
                                       [
                                           'id' => 3,
                                           'name' => 'Rhogar',
                                           'email' => 'rhogar@beatriceweb.com',
                                           'password' => bcrypt('ded'),
                                           'race' => 'Dragonide',
                                           'class' => 'Paladino',
                                           'level' => 1,
                                           'alignment' => 'LN',
                                           'mandatory' => false,
                                           'spells' => 1,
                                       ],
                                       [
                                           'id' => 4,
                                           'name' => 'Reed',
                                           'email' => 'reed@beatriceweb.com',
                                           'password' => bcrypt('ded'),
                                           'race' => 'Halfling',
                                           'class' => 'Ladro',
                                           'level' => 1,
                                           'alignment' => 'NN',
                                           'mandatory' => false,
                                           'spells' => 0,
                                       ],
                                       [
                                           'id' => 5,
                                           'name' => 'Panus',
                                           'email' => 'panus@beatriceweb.com',
                                           'password' => bcrypt('ded'),
                                           'race' => 'Elfo dei boschi',
                                           'class' => 'Druido',
                                           'level' => 1,
                                           'alignment' => 'NG',
                                           'mandatory' => false,
                                           'spells' => 1,
                                       ],
                                       [
                                           'id' => 6,
                                           'name' => 'Alvyn',
                                           'email' => 'alvyn@beatriceweb.com',
                                           'password' => bcrypt('ded'),
                                           'race' => 'Gnomo delle rocce',
                                           'class' => 'Mago',
                                           'level' => 1,
                                           'alignment' => 'CG',
                                           'mandatory' => true,
                                           'spells' => 1,
                                       ],
                                       [
                                           'id' => 7,
                                           'name' => 'Thokk',
                                           'email' => 'thokk@beatriceweb.com',
                                           'password' => bcrypt('ded'),
                                           'race' => 'Mezzorco',
                                           'class' => 'Guerriero',
                                           'level' => 1,
                                           'alignment' => 'CN',
                                           'mandatory' => true,
                                           'spells' => 0,
                                       ],
                                       [
                                           'id' => 8,
                                           'name' => 'Delg',
                                           'email' => 'delg@beatriceweb.com',
                                           'password' => bcrypt('ded'),
                                           'race' => 'Nano delle montagne',
                                           'class' => 'Chierico',
                                           'level' => 1,
                                           'alignment' => 'LG',
                                           'mandatory' => true,
                                           'spells' => 1,
                                       ],
                                   ]);
    }
}
