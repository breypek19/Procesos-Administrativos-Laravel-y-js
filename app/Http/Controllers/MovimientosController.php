<?php

namespace App\Http\Controllers;
use App\Rubroingreso;
use App\Detalleingreso;
use App\Ingreso;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;


//este controlador maneja los reportes en pdf, y reportes en tablas en la pagina
//corresponde a los ingresos
class MovimientosController extends Controller

{

     
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware( 'teso');

        
    }
    private function año(){
        return "2020";
    }
     
   
//para mostrar en un select los rubros que hay, esto es en la vista donde esta el datatable
    public function mostrar(){
        $rubros=Rubroingreso::all();
         
        return view('tesoreria.movimientos', compact("rubros"));
    }


     

    public function registros(){
        //retorna los datos para el datatable de la vista movimientos
        $datos = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=', 'ingresos.rubroingreso_id')
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
      ->select(  'ingresos.id', 'ingresos.cantidad', 'ingresos.dia', 'ingresos.año', 'ingresos.mes','ingresos.descripcion', 'rubroingresos.nombre as rubro', 'detalleingresos.nombre as detalle')
              ->get();

              return DataTables($datos)->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'"
                data-toggle="modal" data-target="#exampleModalCenter"
            class="edit btn btn-primary btn-sm editar">Editar</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm eliminar">Eliminar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function report(){
  //retorna o muestra la vista MostReportes, donde estan los select, y la tabla para los reportes que se puden filtrar
        $rubros= Rubroingreso::all();

        $listaAños = DB::table('ingresos') 
        ->select('año')
        ->distinct()->get();

        $listaMeses = DB::table('ingresos') 
        ->select('mes')
        ->distinct()->get();

        return view('tesoreria.MostReportes', compact("rubros", "listaAños", "listaMeses"));
      

    }

    //en la vista MostReportes hay un select donde estan todos los rubros
    //al escoger una opcion se ejecuta este metodo con el $id de ese rubro
    //y se mandan a la tabla los datos que corresponden con ese rubro, y se mandan al select detalle
    //los detalles que corresponden a ese rubro
    public function filtrarRubro($id){
      //  $rubro= Rubroingreso::find($id);
       // $detalles=$rubro->detalles;   no use la relacion porque se duplicaban los detalles en el select detall,
                                        //habia que ponerle distinct para que no repitiera

        //esta se manda para el select detalle
        $detalles = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->where('rubroingresos.id', $id)
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->select('detalleingresos.id', 'detalleingresos.nombre')
        ->distinct()->get("detalleingresos.nombre");
       


    //este se manda para llenar la tabla
        $datos = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->where('rubroingresos.id', $id)
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->groupBy('rubroingresos.nombre', 'detalleingresos.nombre', 'ingresos.mes', 'ingresos.año')
        ->orderBy('ingresos.año', 'desc')
        ->select(DB::raw(' rubroingresos.nombre as rubro, detalleingresos.nombre as detalle,  sum(ingresos.cantidad) as total, ingresos.mes, ingresos.año'))
              ->get();
       

        return response()->json( ["detalles" => $detalles, "datos" => $datos ] );

    }


    public function filtrarDetalle($rubro, $detalle){

        
        $datos = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->where('rubroingresos.id', $rubro)
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->where('detalleingresos.id', $detalle)
        ->groupBy('rubroingresos.nombre', 'detalleingresos.nombre', 'ingresos.mes', 'ingresos.año')
        ->orderBy('ingresos.año', 'desc')
        ->select(DB::raw(' rubroingresos.nombre as rubro, detalleingresos.nombre as detalle,  sum(ingresos.cantidad) as total, ingresos.mes, ingresos.año'))
              ->get();

              return response()->json( [ "registros" => $datos ] );

    }

// cuando acabe el año 2020, se debe modificar en las funciones de descarga de pdf el ingresos.año =2020
// y se debe cambiar tambien la funcion año() que esta arriba
    public function descargarPdfRubro($id, $año=1, $mes=null){
         $rubro= Rubroingreso::find($id);
         $nombre= $rubro->nombre;

         if($año==1 || $año==2){  //el 2 se lo mando desde js para poder mandar el tercer parametro, es decir si es 1 o 2 es porque no escogieron ningun año en especifico
             $año=getdate()['year']; //año actual
         }
        
    if($mes==null){  //si es null, es decir, sino especificaron ningun mes para la consulta, me traigo todos los meses

        $datos = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->where('rubroingresos.id', $id)
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->where('ingresos.año',$año)
        ->groupBy('rubroingresos.nombre', 'detalleingresos.nombre', 'ingresos.mes')
        ->select(DB::raw('detalleingresos.nombre as detalle,  sum(ingresos.cantidad) as total, ingresos.mes'))
              ->get();
    }else{
        
        $datos = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->where('rubroingresos.id', $id)
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->where('ingresos.año',$año)
        ->where('ingresos.mes',$mes)
        ->groupBy('rubroingresos.nombre', 'detalleingresos.nombre', 'ingresos.mes')
        ->select(DB::raw('detalleingresos.nombre as detalle,  sum(ingresos.cantidad) as total, ingresos.mes'))
              ->get(); 
    }
        return \PDF::loadView('tesoreria.reportesRubro', compact("datos", "nombre", "año", "mes"))
       ->setPaper('a4', 'portrait')
        ->stream('Rubro-' . $nombre . '.pdf');
    }


    public function descargarPdfDetalle($id, $rubr, $año=1){
        
        $detalle= Detalleingreso::find($id)->nombre;
        $rubro= Rubroingreso::find($rubr)->nombre;
         
        if($año==1){
            $año=getdate()['year'];  //si año es igual 1 es porque no escogieron ningun año en espifico, entonces por defecto hago el reporte con el año actual
        }
    
        $dat = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->where('rubroingresos.id', $rubr)
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->where('detalleingresos.id', $id)
        ->where('ingresos.año',$año)
        ->groupBy('rubroingresos.nombre', 'detalleingresos.nombre', 'ingresos.mes')
        ->select(DB::raw(' detalleingresos.nombre as detalle,  sum(ingresos.cantidad) as total, ingresos.mes'))
              ->get();


        return \PDF::loadView('tesoreria.reportesDetalle', compact("dat", "detalle", "rubro", "año"))
        ->setPaper('a4', 'portrait')
         ->stream($rubro . '-' . $detalle .'.pdf');
    }

//muestro la vista para liquidar diezmos
    public function mostrarDiez(){
        $rubrosm= Rubroingreso::all();
        return view("tesoreria.diezmos", compact("rubrosm"));
    }


    public function descargarInfoGeneralPdf($mes){

    $nombre= $this->meses($mes);        
    $año=getdate()['year'];
    //ingreso
        $dat = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->where([['ingresos.mes', $mes], ['ingresos.año', $año]])
        ->groupBy('rubroingresos.nombre', 'detalleingresos.nombre')
        ->select(DB::raw('rubroingresos.nombre as rubro,  detalleingresos.nombre as detalle,  sum(ingresos.cantidad) as total'))
              ->get();

              //egreso
              $datEgreso = DB::table('rubroegresos')
              ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
              ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
              ->where([['egresos.mes', $mes], ['egresos.año', $año]])
              ->groupBy('rubroegresos.nombre', 'detallegresos.nombre')
              ->select(DB::raw('rubroegresos.nombre as rubro,  detallegresos.nombre as detalle,  sum(egresos.cantidad) as total'))
                    ->get();

        return \PDF::loadView('tesoreria.informeGene', compact("dat", "nombre", "año", "datEgreso"))
        ->setPaper('a4', 'portrait')
         ->stream('InformeMes.pdf');
    }

//este metodo es para filtrar por varios meses: enero a marzo, enero a abril, febrero a noviembre, etc..
    public function descargarInfoGeneralMesesPdf($inicio, $fin){
        $año=getdate()['year'];
        $mesInicio=$this->meses($inicio); //uso la funcion meses para traerme el nombre del mes que escogieron
        $mesFin= $this->meses($fin);   //lo mism
//ingreso
        $datos = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=' ,  'ingresos.rubroingreso_id')
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->where('ingresos.año',$año)
        ->whereBetween('ingresos.mes', [$inicio, $fin])
        ->groupBy('rubroingresos.nombre', 'detalleingresos.nombre')
        ->select(DB::raw('rubroingresos.nombre as rubro,  detalleingresos.nombre as detalle,  sum(ingresos.cantidad) as total'))
              ->get();
//egreso
              $datosE = DB::table('rubroegresos')
              ->join('egresos', 'rubroegresos.id', '=' ,  'egresos.rubroegreso_id')
              ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
              ->where('egresos.año',$año)
              ->whereBetween('egresos.mes', [$inicio, $fin])
              ->groupBy('rubroegresos.nombre', 'detallegresos.nombre')
              ->select(DB::raw('rubroegresos.nombre as rubro,  detallegresos.nombre as detalle,  sum(egresos.cantidad) as total'))
                    ->get();

              return \PDF::loadView('tesoreria.informeGeneMeses', compact("datos", "año", "mesInicio", "mesFin", "datosE"))
        ->setPaper('a4', 'portrait')
         ->stream('informeMeses.pdf');

    }

    public function descargarLiquidacionPdf($cadena, $cadena1){
        $rubroingreso= new Rubroingreso;
        $datos = json_decode($cadena);
        $datos1 = json_decode($cadena1);

        $ultimo = DB::table('ingresos')
        ->orderBy('id', 'desc')
        ->limit(1)
        ->get();
          
              return \PDF::loadView('tesoreria.liquidacionDiezmo', compact("datos", "datos1", "rubroingreso", "ultimo"))
        ->setPaper('a4',"portrait")
         ->stream('LiquidacionDiezmo.pdf');

    }

    private function meses($mes){
        $nombre="";
        switch ($mes) {
            case "01":
                $nombre= "Enero";
                break;
            case "02":
            $nombre= "Febrero";
                break;
            case "03":
                $nombre= "Marzo";
                    break;
             case "04":
                    $nombre= "Abril";
                        break;
              case "05":
                        $nombre= "Mayo";
                            break;
              case "06":
                 $nombre= "Junio";
                 break; 
                 
                 case "07":
                    $nombre= "Julio";
                         break; 
                 case "08":
                     $nombre= "Agosto";
                          break; 
                 case "09":
                        $nombre= "Septiembre";
                          break;
                 case "10":
                          $nombre= "Octubre";
                            break;
                 case "11":
                            $nombre= "Noviembre";
                              break;
                 case "12":
                    $nombre= "Diciembre";
                         break;
            
        }  
return $nombre;
    }
}
