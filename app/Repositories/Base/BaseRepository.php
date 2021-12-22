<?php   

namespace App\Repositories\Base;   

use Illuminate\Database\Eloquent\Model;   

abstract class BaseRepository 
{     
    /**      
     * @var Model      
     */     
    protected $model;       

    /**      
     * BaseRepository constructor.      
     * 
     * @param Model $model    
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
}