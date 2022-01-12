<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;

class Activities extends Component
{
    public function render()
    {
        return view('admin.livewire.activities', [
            'activities' => Activity::orderBy('order')->get()
        ]);
    }

    public function updateOrder($list)
    {
        foreach($list as $item)
        {
            Activity::find($item['value'])->update(['order' => $item['order']]);
        }
    }
}
