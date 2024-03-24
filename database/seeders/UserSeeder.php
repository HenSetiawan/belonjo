<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Hendy Setiawan",
            'email' => "hendysetiawan@gmail.com",
            'password'=>Hash::make('ganteng'),
            'role'=>'admin',
            'phone'=>'083848939629',
            'address'=>'Kab.Ngawi, Kec.Widodaren, Ds.Sekaralas'
        ]);

            DB::table('users')->insert([
            'name' => "Budi Anton",
            'email' => "budi@gmail.com",
            'password'=>Hash::make('ganteng'),
            'role'=>'user',
            'phone'=>'083848939629',
            'address'=>'Kab.Ngawi, Kec.Widodaren, Ds.Sekaralas'
        ]);

    }
}
