<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'login' => 'user1',
            'password' => Hash::make('password1'),
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'created_at' => '2024-05-25 16:06:21',
            'updated_at' => '2024-05-25 16:06:21',
        ]);
        DB::table('users')->insert([
            'login' => 'user2',
            'password' => Hash::make('password2'),
            'name' => 'Хоттаб',
            'surname' => 'Хоттабыч',
            'created_at' => '2024-05-25 16:06:21',
            'updated_at' => '2024-05-25 16:06:21',
        ]);
    }
}
