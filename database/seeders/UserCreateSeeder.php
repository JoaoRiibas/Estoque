<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [[
            'username' => 'Ribas',
            'email' => 'jvrcoelho@gmail.com',
            'password' => bcrypt('123321'), // password
        ]];

        foreach($datas as $data){
            User::create($data);
        }
    }
}
