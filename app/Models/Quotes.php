<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    public $timestamps      = false;
    protected $table        = 'quotes';
    protected $primaryKey   = 'id';
    protected $fillable     = ['quotes', 'creator'];
}
