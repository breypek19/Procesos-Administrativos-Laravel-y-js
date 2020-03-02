<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{

    protected $guarded = [];
  
   
    public function profesion()
    {
        return $this->belongsTo('App\Profesion');
    }
}
