<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Ingreso extends Pivot
{
    public $incrementing = true;


    protected $fillable = [
        'rubroingreso_id', 'detalleingres_id', 'cantidad', 'mes', 'año', 'dia', 'descripcion'
      ];

}

