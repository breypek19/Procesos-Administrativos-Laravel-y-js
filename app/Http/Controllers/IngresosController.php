<?php

namespace App\Http\Controllers;

use App\Detallegreso;
use App\Rubroingreso;
use App\Detalleingreso;
use App\Ingreso;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\RequestRubro;
use App\Http\Requests\RequestDetalle;
use App\Rubroegreso;

use function GuzzleHttp\json_decode;

class IngresosController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
    $this->middleware( 'teso');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubro=Rubroingreso::all();
        

        return view("tesoreria.ingresosCreate", ['rubros' => $rubro]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRubro $request)
    {
        $validated = $request->validated();

        $rubro = new Rubroingreso;

        $rubro->nombre = $request->nom;
        $rubro->save();
        $datos= $rubro::all()->last(); //me traigo enseguida el ultimo registros, es decir, el que acabé de guardar, y lo mando para actualizar solo el select de rubro
        return response()->json(["mensaje" => "Se realizo con exito la operacion", "row" => $datos]);
 
    }

   
    public function ejecutarPdf($id){
      
     //en la clase rubroingreso tengo las funciones para convertir la cantidad a letras
    $rubro=  new Rubroingreso;
     
        $datos= DB::selectOne('select ingresos.id, rubroingresos.nombre as rubro, 
        detalleingresos.nombre as detalle,  ingresos.cantidad, ingresos.dia, ingresos.mes, 
         ingresos.año  
        from ingresos inner join rubroingresos  on  ingresos.rubroingreso_id=rubroingresos.id 
         inner join detalleingresos on  ingresos.detalleingreso_id=detalleingresos.id where ingresos.id=?', [$id]);

    
  
     $letras=  $rubro->convertirNumeroLetra($datos->cantidad);

    
  
       return \PDF::loadView('tesoreria.comprobCopy', compact("datos", "letras"))
       ->setPaper('a4', 'landscape')
        ->stream('C-Ingreso_' . $datos->rubro . '_' . $datos->detalle .  '.pdf'); //si lo quiero descargar enseguida uso download(), si lo quiero ver en el navegador uso stream()
 
    }


    public function general(Request $request)
    {
      
      /*
      $rubro = Rubroingreso::find($request->rubro);
    $rubro->detalles()->attach($request->detalle, ['cantidad' => $request->cantid,
       'dia' => $request->dia, 'mes' =>$request->mes, 'año' =>$request->ano,
      "descripcion" => $request->coment]);
      */
/*
  en el procedimiento inserto los datos y devuelvo el id con LAST_INSERT_ID(),
 mando el id como respuesta para abrir el comprobante de ingreso que se acaba de efectuar
 */
       $data=  DB::select('call registro_Ingresos(?,?,?,?,?,?,?)',
        array($request->rubro, $request->detalle, $request->cantid,
        $request->dia, $request->mes, $request->ano, $request->coment));
          
         return response()->json( ["dato" => $data[0]->id ] );   //ahora borrar los datos del formulario, al realizar el ingreso
    }



    public function Diezmogeneral(Request $request)
    {
      
       $rubroE= Rubroegreso::where("nombre", "diezmo")->first();
       $detalleE=Detallegreso::where("nombre", "diezmo neto")->first();
        $rubro = Rubroingreso::find($request->rubro);

        //diezmo bruto
    $rubro->detalles()->attach($request->detalle, ['cantidad' => $request->cantid,
         'dia' => $request->dia, 'mes' =>$request->mes, 'año' =>$request->ano,
          "descripcion" => $request->coment]);

          //diezmo neto
          $rubroE->detallesE()->attach($detalleE->id, ['cantidad' => $request->net,
          'dia' => $request->dia, 'mes' =>$request->mes, 'año' =>$request->ano,
           "descripcion" => " diezmo neto Pastor"]);
          
          
        
     

     //    return response()->json( ["dato" => $request->rubro ] );   //ahora borrar los datos del formulario, al realizar el ingreso
    }


    public function detalle(RequestDetalle $request)
    {
        $validated = $request->validated();
      
       $detalle= new Detalleingreso;
       $detalle->nombre=$request->detall;

      $detalle->save();

        return response()->json(["mensaje" => "Se realizo con exito la operacion"]);
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cadena)
    {
        
       


        $detalle = Detalleingreso::where('nombre','LIKE', "%".  $cadena . "%")
        ->orderBy('nombre', 'asc')
        ->get();

        return response()->json(["detalle" => $detalle, "cadena" => $cadena]);
       


    }


    public function detalleDiezmo($cadena)
    {
        
       


        $detalle = Detalleingreso::where('nombre','LIKE',   $cadena . "%")
        ->get()->first();

        return response()->json(["detalle" => $detalle, "cadena" => $cadena]);
       


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos = DB::table('rubroingresos')
        ->join('ingresos', 'rubroingresos.id', '=', 'ingresos.rubroingreso_id')
        ->where("ingresos.id", $id)
        ->join('detalleingresos', 'detalleingresos.id', '=', 'ingresos.detalleingreso_id')
        ->where("ingresos.id", $id)
      ->select(  'ingresos.id', 'ingresos.cantidad','detalleingresos.id as idDetalle', 'rubroingresos.id as idRubro', 'ingresos.descripcion', 'detalleingresos.nombre as detalle')
              ->get();

               return response()->json([ "datos" =>$datos]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

    $fecha = Carbon::parse($request->fecha);
    $mes = $fecha->month;
    $dia = $fecha->day;
    $ano = $fecha->year;
    if($mes<10){
     $mes='0'. $mes;
    }

        $datos = DB::table('ingresos')
        ->where("id", $id)
        ->update(['rubroingreso_id' => $request->rubro, "detalleingreso_id" =>$request->id_detalle , "cantidad" => $request->cantidad, "dia"=>$dia,
        "mes" =>$mes, "año"=>$ano, "descripcion"=> $request->comentario
        
        ]);

        return back()->withInput(); //A veces es posible que desee redirigir al usuario a su ubicación anterior
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('ingresos')->where('id', $id)->delete();
        return "Ingreso Elimnado con Exito";
    }

    


}
