<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallegreso extends Model
{
    protected $fillable = [
        'nombre'
    ];

    public function RubrosE(){
        return $this->belongsTo("App\Detallegreso", 'egresos', 'detallegreso_id', 'rubroegreso_id')->withPivot('id', 'cantidad','dia', "mes", "año","descripcion")->withTimestamps();
    }
}
