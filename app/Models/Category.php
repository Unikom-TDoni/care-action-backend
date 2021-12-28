<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\News;

class Category extends Model
{
    // use HasFactory;
    public $timestamps      = false;
    protected $table        = 'category';
    protected $primaryKey   = 'id_category';
    protected $fillable     = ['category_name', 'icon'];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'category'");

        return $statement[0]->Auto_increment;
    }
}
