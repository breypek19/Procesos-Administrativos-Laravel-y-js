<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleingreso extends Model
{
    protected $fillable = [
        'nombre'
      ];



      public function rubros(){  
          return $this->belongsTo('App\Rubroingreso', 'ingresos', 'detalleingreso_id', 'rubroingreso_id' )->withPivot('id', 'cantidad','dia', "mes", "año","descripcion")->withTimestamps();
                            //por defecto en la tabla intermedia solo se guardan los id o claves de las dos tables
                            //si hay atributos adicionales se deben especificar en la relacion con withPivot
      }
}
