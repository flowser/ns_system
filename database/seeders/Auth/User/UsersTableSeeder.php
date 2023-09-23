<?php

namespace Database\Seeders\Auth\User;


use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        User::create([
            'first_name'        => 'Eng. Felix',
            'last_name'         => 'Nyachio',
            'email'             => 'felixnyachio@gmail.com',
            'password'          => Hash::make('feliX1234*'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]); //2
        User::create([
            'first_name'        => 'Max',
            'last_name'         => 'Nyachio',
            'email'             => 'max@gmail.com',
            'password'          => Hash::make('feliX1234*'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]); //2
        User::create([
            'first_name'        => 'Lex',
            'last_name'         => 'Nyachio',
            'email'             => 'Lex@gmail.com',
            'password'          => Hash::make('feliX1234*'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]); //2
    }
}

