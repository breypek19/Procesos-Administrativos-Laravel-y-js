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
      

      $rubro=  Rubroingreso::find($id);
      $concepto=$rubro->nombre;
          
       $datos=$rubro->detalles->last();   //me traigo el ultimo registro, el que acabe de guardar
      
    
     $letras=  $rubro->convertirNumeroLetra($datos->pivot->cantidad);
     

       return \PDF::loadView('tesoreria.comprobIng2', compact("datos", "letras", "concepto"))
       ->setPaper('a4', 'landscape')
        ->stream('C-Ingreso_' . $concepto . '_' . $datos->nombre .  '.pdf'); //si lo quiero descargar enseguida uso download(), si lo quiero ver en el navegador uso stream()
 
    }


    public function general(Request $request)
    {
      
      
        $rubro = Rubroingreso::find($request->rubro);
    $rubro->detalles()->attach($request->detalle, ['cantidad' => $request->cantid,
         'dia' => $request->dia, 'mes' =>$request->mes, 'año' =>$request->ano,
          "descripcion" => $request->coment]);
          
          
        
     

         return response()->json( ["dato" => $request->rubro ] );   //ahora borrar los datos del formulario, al realizar el ingreso
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
