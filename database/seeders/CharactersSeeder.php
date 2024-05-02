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
        DB::table('users')->insert([
                                       [
                                           'name' => 'Beatrice',
                                           'email' => 'info@beatriceweb.it',
                                           'password' => bcrypt('silvestro1'),
                                           'is_admin' => true,
                                       ],
                                       [
                                           'name' => 'Lucian',
                                           'email' => 'lucian@beatriceweb.com',
                                           'password' => bcrypt('ded')
                                       ],
                                       [
                                           'name' => 'Rhogar',
                                           'email' => 'rhogar@beatriceweb.com',
                                           'password' => bcrypt('ded')
                                       ],
                                       [
                                           'name' => 'Reed',
                                           'email' => 'reed@beatriceweb.com',
                                           'password' => bcrypt('ded')
                                       ],
                                       [
                                           'name' => 'Panus',
                                           'email' => 'panus@beatriceweb.com',
                                           'password' => bcrypt('ded')
                                       ],
                                       [
                                           'name' => 'Alvyn',
                                           'email' => 'alvyn@beatriceweb.com',
                                           'password' => bcrypt('ded')
                                       ],
                                       [
                                           'name' => 'Thokk',
                                           'email' => 'thokk@beatriceweb.com',
                                           'password' => bcrypt('ded')
                                       ],
                                       [
                                           'name' => 'Delg',
                                           'email' => 'delg@beatriceweb.com',
                                           'password' => bcrypt('ded')
                                       ],
                                   ]);
    }
}
