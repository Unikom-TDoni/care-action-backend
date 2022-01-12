<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\News;

class Activity extends Model
{
    // use HasFactory;
    public $timestamps      = false;
    protected $table        = 'activity';
    protected $primaryKey   = 'id';
    protected $fillable     = ['activity_name', 'icon', 'order'];

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'activity'");

        return $statement[0]->Auto_increment;
    }

    public function getTracker($date, $id_customer) 
    {
        $query = DB::table('activity_tracker')->where('date', $date)->where('id_customer', $id_customer);
        
        return $query;
    }

    public function checklistTracker($date, $id_customer, $id_activity, $checked)
    {
        $query  = DB::table('activity_tracker')->where('date', $date)->where('id_customer', $id_customer)->where('id_activity', $id_activity);
        $data   = $query->first();

        if($checked)
        {
            if(!isset($data))
            {
                $query = DB::table('activity_tracker')->insert([
                            'date'          => $date,
                            'id_customer'   => $id_customer,
                            'id_activity'   => $id_activity
                        ]);
            }
        }
        else
        {
            $query = $query->delete();
        }
        
        return $query;
    }
}
