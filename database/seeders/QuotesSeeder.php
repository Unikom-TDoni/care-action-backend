<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotesSeeder extends Seeder
{
    private $data = [
        ['quotes' => 'When wealth is lost, nothing is lost; when health is lost, something is lost; when character is lost, all is lost.', 'creator' => 'Billy Graham'],
        ['quotes' => 'He who has health, has hope; and he who has hope, has everything.', 'creator' => 'Thomas Carlyle'],
        ['quotes' => 'A healthy outside starts from the inside.', 'creator' => 'Robert Urich'],
        ['quotes' => 'I believe that the greatest gift you can give your family and the world is a healthy you.', 'creator' => 'Joyce Meyer'],
        ['quotes' => 'Early yo bed and early to rise, makes a man healthy, wealthy and wise.', 'creator' => 'Unknown'],
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
            DB::table('quotes')->insert($d);
        }
    }
}
