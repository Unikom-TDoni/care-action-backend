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
}
