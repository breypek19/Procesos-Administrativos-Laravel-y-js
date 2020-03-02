<?php

namespace App\Http\Controllers;
use App\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SecreAsistenciasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('secre');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("secretaria.asistencia");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asistencia= new Asistencia();
        $asistencia->canti_hermanos=$request->herm; 
        $asistencia->canti_hermanas=$request->hermanas; 
        $asistencia->canti_visitas=$request->visi; 
        $asistencia->canti_niños=$request->nin; 
        $asistencia->dia=$request->di; 
        $asistencia->mes=$request->me; 
        $asistencia->año=$request->año; 
        $asistencia->dia_semana=$request->dia_seman;

       
        
        $asistencia->save();
        
        return response()->json(["mensaje" => "Registro Exitoso"]);
    }


    public function verificar($año, $mes, $dia, $dia_semana){

        $row= Asistencia::where([["año", $año], [ "mes", $mes],[ "dia",$dia]])->get();
       
        $datos = DB::table('asistencias')
        ->select(DB::raw('mes,dia_semana, ROUND(avg(canti_hermanos),0) as hermanos, ROUND(avg(canti_hermanas),0) as hermanas, ROUND(avg(canti_visitas),0) as visitas, ROUND(avg(canti_niños),0) as niños')) 
             ->where([["año",$año], ["mes", $mes], ["dia_semana", $dia_semana ]])
             ->groupBy("año", "mes", "dia_semana")
             ->get();

       
        return response()->json(["fila" =>$row, "promedio" => $datos]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
