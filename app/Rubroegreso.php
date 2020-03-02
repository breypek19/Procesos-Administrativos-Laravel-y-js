<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubroegreso extends Model
{

    protected $fillable = [
        'nombre'
    ];
    
    public function detallesE(){
        return $this->belongsToMany('App\Detallegreso', 'egresos', "rubroegreso_id", "detallegreso_id" )
        ->withPivot('id', 'cantidad','dia', "mes", "año","descripcion")->withTimestamps();
                  
       }  
}
