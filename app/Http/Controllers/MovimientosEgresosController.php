<?php

namespace App\Http\Controllers;

use App\Rubroegreso;
use App\Detallegreso;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class MovimientosEgresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware( 'teso');

        
    }

//nos envia a la vista reportes para filtrar por rubros, detalles, años y meses
    public function mostrarVistaParaFiltrar(){
        $rubros=Rubroegreso::all();

        $listaA = DB::table('egresos') 
        ->select('año')
        ->distinct()->get();

        $listaM = DB::table('egresos') 
        ->select('mes')
        ->distinct()->get();
         
        return view('tesoreria.egresos.reportes', compact("rubros", "listaA", "listaM"));
    }

    public function filtrarRubro($id){
    
        $detalles = DB::table('rubroegresos')
        ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
        ->where('rubroegresos.id', $id)
        ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
        ->select('detallegresos.id', 'detallegresos.nombre')
        ->distinct()->get("detallegresos.nombre");


        $registros = DB::table('rubroegresos')
        ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
        ->where('rubroegresos.id', $id)
        ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
        ->groupBy('rubroegresos.nombre', 'detallegresos.nombre', 'egresos.mes', 'egresos.año')
        ->orderBy('egresos.año', 'desc')
        ->select(DB::raw(' rubroegresos.nombre as rubro, detallegresos.nombre as detalle,  sum(egresos.cantidad) as total, egresos.mes, egresos.año'))
              ->get();
       

              return response()->json( ["detalles" => $detalles, "registros" => $registros ] );

    }


    public function filtrarRubroDetalle($rubro,$detalle){
        $datos = DB::table('rubroegresos')
        ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
        ->where('rubroegresos.id', $rubro)
        ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
        ->where('detallegresos.id', $detalle)
        ->groupBy('rubroegresos.nombre', 'detallegresos.nombre', 'egresos.mes', 'egresos.año')
        ->orderBy('egresos.año', 'desc')
        ->select(DB::raw(' rubroegresos.nombre as rubro, detallegresos.nombre as detalle,  sum(egresos.cantidad) as total, egresos.mes, egresos.año'))
              ->get();

              return response()->json( [ "registros" => $datos ] );
    }


    //muestr los rubros que hay en un select en la vida datatable para editar los registros
    public function mostrarVistaDatatable(){

        $rubros=Rubroegreso::all();
        return view('tesoreria.egresos.listaEgresos', compact("rubros"));
    }

    public function listarEnDatatable(){



          //retorna los datos para el datatable de la vista movimientos
          $datos = DB::table('rubroegresos')
          ->join('egresos', 'rubroegresos.id', '=', 'egresos.rubroegreso_id')
          ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
        ->select(  'egresos.id', 'egresos.cantidad', 'egresos.dia', 'egresos.año', 'egresos.mes','egresos.descripcion', 'rubroegresos.nombre as rubro', 'detallegresos.nombre as detalle')
                ->get();
  
                return DataTables($datos)->addColumn('action', function($data){
                  $button = '<button type="button" name="edit" id="'.$data->id.'"
                  data-toggle="modal" data-target="#exampleModalCenter"
              class="editEgreso btn btn-primary btn-sm editar">Editar</button>';
                  $button .= '&nbsp;&nbsp;';
                  $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm eliminarEgre">Eliminar</button>';
                  return $button;
              })
              ->rawColumns(['action'])
              ->make(true);
    }




   public function reporPdfRubro($id, $anio=1, $mes=null){

      if($anio==1 || $anio==2){   //si cuando doy el reporte no hay ningun año especificado
          $fechaActual=getdate();   //uso el año actual para hacer la consulta
          $anio=$fechaActual['year'];
      }

    $rubro= Rubroegreso::find($id);
    $nombre= $rubro->nombre;
   
 
if($mes===null ){ //esto lo hago para dar funcionalidad adicional, sino eligen algun mes muestro todos los meses en el reportePdf, pero si eligen algun mes solo me traigo esos
   $datos = DB::table('rubroegresos')
   ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
   ->where('rubroegresos.id', $id)
   ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
   ->where('egresos.año',$anio)
   ->groupBy('rubroegresos.nombre', 'detallegresos.nombre', 'egresos.mes')
   ->select(DB::raw('detallegresos.nombre as detalle,  sum(egresos.cantidad) as total, egresos.mes'))
         ->get();

}else{
   $datos = DB::table('rubroegresos')
   ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
   ->where('rubroegresos.id', $id)
   ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
   ->where('egresos.año',$anio)
   ->where('egresos.mes',$mes)
   ->groupBy('rubroegresos.nombre', 'detallegresos.nombre', 'egresos.mes')
   ->select(DB::raw('detallegresos.nombre as detalle,  sum(egresos.cantidad) as total, egresos.mes'))
         ->get(); 
}     

   return \PDF::loadView('tesoreria.egresos.pdfRubro', compact("datos", "nombre", "anio", "mes"))
  ->setPaper('a4', 'portrait')
   ->stream('Rubro-' . $nombre . '.pdf');

   }



  public function  reporPdfDetalle($rubr, $id, $año=1){

    
    $detalle= Detallegreso::find($id)->nombre;
    $rubro= Rubroegreso::find($rubr)->nombre;
     
     if($año==1){  //si año == 1 es porque desde js se hizo la consulta a la ruta sin ese parametro(que es opcional), lo cual indica que no se eligio ningun año en particular
        $fechaAc=getdate();   //uso el año actual para hacer la consulta
        $año=$fechaAc['year'];
     }

    $dat = DB::table('rubroegresos')
    ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
    ->where('rubroegresos.id', $rubr)
    ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
    ->where('detallegresos.id', $id)
    ->where('egresos.año',$año)
    ->groupBy('rubroegresos.nombre', 'detallegresos.nombre', 'egresos.mes')
    ->select(DB::raw(' detallegresos.nombre as detalle,  sum(egresos.cantidad) as total, egresos.mes'))
          ->get();


    return \PDF::loadView('tesoreria.egresos.pdfDetalle', compact("dat", "detalle", "rubro", "año"))
    ->setPaper('a4', 'portrait')
     ->stream($rubro . '-' . $detalle .'.pdf');



  }

}

