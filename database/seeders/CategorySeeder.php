<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    private $data = [
        ['category_name' => 'Healthy', 'icon' => '1.png'],
        ['category_name' => 'Exercise', 'icon' => '2.png'],
        ['category_name' => 'Food', 'icon' => '3.png'],
        ['category_name' => 'Mind', 'icon' => '4.png'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $d) 
        {
            DB::table('category')->insert($d);
        }
    }
}
