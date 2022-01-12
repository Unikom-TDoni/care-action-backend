<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    private $data = [
        ['order' => '1', 'activity_name' => 'Drinkin Water 2L', 'icon' => '1.png'],
        ['order' => '2', 'activity_name' => 'Eat Food 1600-3000 Calories', 'icon' => '2.png'],
        ['order' => '3', 'activity_name' => 'Workout 30 Minutes', 'icon' => '3.png'],
        ['order' => '4', 'activity_name' => 'Meditate 30 Minutes', 'icon' => '4.png'],
        ['order' => '5', 'activity_name' => 'Sleep 8 Hours', 'icon' => '5.png'],
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
            DB::table('activity')->insert($d);
        }
    }
}
