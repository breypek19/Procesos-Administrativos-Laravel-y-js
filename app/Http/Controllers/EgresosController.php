<?php

namespace App\Http\Controllers;
use App\Http\Requests\RequestRubroE;
use App\Http\Requests\RequestDetalleE;
use Illuminate\Http\Request;
use App\Detallegreso;
use App\Rubroegreso;
use App\Rubroingreso;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class EgresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
{
    $this->middleware('auth');
    $this->middleware( 'teso');
}



    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubrosE= Rubroegreso::all();
        return view("tesoreria.egresos.egresosCreate", compact("rubrosE"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //guardar el egreso total
    public function store(Request $request)
    {
        $rubro=Rubroegreso::find($request->rubroE);
        $rubro->detallesE()->attach($request->detalleE, ['cantidad' => $request->cantidadE, 'dia' =>$request->diaE,
         "mes"=>$request->mesE, "año" => $request->anoE, "descripcion" =>$request->comen ] );

         return response()->json(["mensaje" => "Egreso guardado", "dato"=> $request->rubroE ]);
    }



  public function storeRubro(RequestRubroE $request){
      $valid= $request->validated();

      $rubroE= new Rubroegreso();
      $rubroE->nombre= $request->nombreRubro;
      $rubroE->save();
      $dato= $rubroE::all()->last();//quizas esto no sea lo mejor, pero sirve para poner en el select rubro, el rubro que recien se acabo de crear, sin recargar la pagina 

      return response()->json(["mensaje" => "Se Guardo correctamente", "dato" => $dato]);



  }


  public function storeDetalle(RequestDetalleE $request){

    $valid= $request->validated();

    $detalleE= new Detallegreso();
    $detalleE->nombre= $request->nombreDetalle;
    $detalleE->save();
  

    return response()->json(["mensaje" => "Se Guardo correctamente"]);

}


public function comprobanteEgreso($id){
    
    $funcionLetras=new Rubroingreso();
    $rubro=  Rubroegreso::find($id); //este id viene desde js con windows open, es el id que se acabo de guardar en la bd en el egreso
    $datos=  $rubro->detallesE->last();   //uso el id para traerme de todos sus detalles (recordemos que ademas del deatalle, viene con la tabla pivot), el ulimo

    $letras=  $funcionLetras->convertirNumeroLetra($datos->pivot->cantidad);
    

    return \PDF::loadView('tesoreria.egresos.comprobEgreso', compact("datos", "letras"))
    ->setPaper('a4', 'landscape')
     ->stream('Egreso.pdf'); //si lo quiero descargar enseguida uso download(), si lo quiero ver en el navegador uso stream()

}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cadena)
    {
        
        $detalle = Detallegreso::where('nombre','LIKE', "%" .  $cadena . "%")
                ->orderBy('nombre', 'asc')
                    ->get();

        return response()->json(["detalles" => $detalle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $datos = DB::table('egresos')
        ->where("egresos.id", $id)
        ->join('rubroegresos', 'rubroegresos.id', '=', 'egresos.rubroegreso_id')
        ->join('detallegresos', 'detallegresos.id', '=', 'egresos.detallegreso_id')
        
      ->select(  'egresos.id', 'egresos.cantidad','detallegresos.id as idDetalle', 'rubroegresos.id as idRubro', 'egresos.descripcion', 'detallegresos.nombre as detalle')
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
    public function update(Request $request, $id)
    {
        $fecha = Carbon::parse($request->fechaE);
        $mes = $fecha->month;
        $dia = $fecha->day;
        $ano = $fecha->year;
        if($mes<10){
         $mes='0'. $mes;
        }
    
            $datos = DB::table('egresos')
            ->where("id", $id)
            ->update(['rubroegreso_id' => $request->rubroE, "detallegreso_id" =>$request->id_detalleE , "cantidad" => $request->cantidadE, "dia"=>$dia,
            "mes" =>$mes, "año"=>$ano, "descripcion"=> $request->comentarioE
            
            ]);
    
            return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('egresos')->where('id', $id)->delete();
        return "Egreso Eliminado con Exito";
    }
}
