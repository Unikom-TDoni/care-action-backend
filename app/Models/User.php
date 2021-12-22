<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\Berita;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function getDetailDataByUsername($username) 
    {
        $query = DB::table('users')->where("username", $username);

        return $query;
    }
}
