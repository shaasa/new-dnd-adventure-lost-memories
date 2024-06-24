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
        //DB::table('users')->truncate();
        DB::table('users')->insert([

                                        'id' => 1,
                                       'name' => 'Beatrice',
                                       'email' => 'info@beatriceweb.it',
                                       'password' => bcrypt('silvestro1'),
                                       'is_admin' => true,
                                   ]);
        DB::table('characters')->insert([
                                       [
                                           'name' => 'Lucian',
                                           'race' => 'Elfo dei boschi',
                                           'class' => 'Ranger',
                                           'level' => 1,
                                           'alignment' => 'CG',
                                           'mandatory' => false,
                                           'spells' => 0,
                                       ],
                                       [
                                           'name' => 'Rhogar',
                                           'race' => 'Dragonide',
                                           'class' => 'Paladino',
                                           'level' => 1,
                                           'alignment' => 'LN',
                                           'mandatory' => false,
                                           'spells' => 1,
                                       ],
                                       [
                                           'name' => 'Reed',
                                           'race' => 'Halfling',
                                           'class' => 'Ladro',
                                           'level' => 1,
                                           'alignment' => 'NN',
                                           'mandatory' => false,
                                           'spells' => 0,
                                       ],
                                       [
                                           'name' => 'Panus',
                                           'race' => 'Elfo dei boschi',
                                           'class' => 'Druido',
                                           'level' => 1,
                                           'alignment' => 'NG',
                                           'mandatory' => false,
                                           'spells' => 1,
                                       ],
                                       [
                                           'name' => 'Alvyn',
                                           'race' => 'Gnomo delle rocce',
                                           'class' => 'Mago',
                                           'level' => 1,
                                           'alignment' => 'CG',
                                           'mandatory' => true,
                                           'spells' => 1,
                                       ],
                                       [
                                           'name' => 'Thokk',
                                           'race' => 'Mezzorco',
                                           'class' => 'Guerriero',
                                           'level' => 1,
                                           'alignment' => 'CN',
                                           'mandatory' => true,
                                           'spells' => 0,
                                       ],
                                       [
                                           'name' => 'Delg',
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
