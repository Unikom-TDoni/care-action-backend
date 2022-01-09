<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\User;

class News extends Model
{
    // use HasFactory;
    public $timestamps      = false;
    protected $table        = 'news';
    protected $primaryKey   = 'id_news';

    protected $fillable = [
        'id_category', 
        'id_user', 
        'created_at', 
        'title', 
        'thumbnail',
        'content',
        'is_recommended'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'news'");

        return $statement[0]->Auto_increment;
    }
}
