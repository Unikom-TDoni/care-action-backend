<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer')->insert([
            'email'         => 'budi@gmail.com',
            'name'          => 'budi',
            'birthdate'     => '2000-01-01',
            'gender'        => 'Male',
            'weight'        => 65,
            'height'        => 170,
            'password'      => Hash::make('123'),
            'created_at'    => NOW(),
            'updated_at'    => NOW(),
        ]);
    }
}
