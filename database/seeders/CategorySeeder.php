<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    private $data = [
        ['category_name' => 'Healthy'],
        ['category_name' => 'Work Out'],
        ['category_name' => 'Food'],
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
