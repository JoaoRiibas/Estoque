<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Joao Ribas',
            'email' => 'jv.ribas@setrasolucoes.com.br',
            'password' => bcrypt('123321')
        ]);
    }
}
