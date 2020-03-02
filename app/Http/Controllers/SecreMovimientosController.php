<?php

namespace App\Http\Controllers;
use App\Profesion;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProfesion;
use App\Http\Requests\RequestPersonas;
use Illuminate\Support\Facades\DB;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;

class SecreMovimientosController extends Controller
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
             $prof= Profesion::all();
        return view("secretaria.personas", compact("prof"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestPersonas $request)
    {
        $validated=$request->validated();
           
           $prof= Profesion::find($request->profesionP);
           $person = new Persona(['nombres' => $request->nombresP, "apellidos" => $request->apellidosP,
             "lugar_nacimiento"=> $request->lugarN, "fecha_nacimiento" => $request->fechaNacP,
             "sexo" => $request->sexoP, "identificacion" => $request->identificacionP, "direccion_residencia" => $request->direccionP,
             "correo"=>$request->correoP, "telefono" =>$request->telefonoP, "estado_civil" =>$request->estadoCiviP,
             "nom_conyugue" => $request->pareja, "cant_hijos" =>$request->cantidadHijoP, "nombre_hijos" =>$request->nombreHijosP,
              "bautismo" => $request->bautismoP, "fecha_bautismo" =>$request->fechaBautiP, "pastor_bautismo" => $request->nombrePastorP,
              "espiritu" =>$request->EspirituS, "fecha_espiritu" =>$request->fechaE, "cargos" => $request->cargosServicio,
              "estado" =>$request->estadoP 
           ]);
           $prof->personas()->save($person);


           return response()->Json(["mensaje" => "Registro Exitoso"]);

    }


    public function guardarProfesion(RequestProfesion $request){
 
        $validated = $request->validated();

        $profesion= new Profesion();

        $profesion->nombre=$request->nom;
        $profesion->save();

        $dato= $profesion::all()->last();
        return response()->json(["mensaje" => "Se realizo con exito la operacion", "dato" => $dato]);


    }

    public function mostrarVistaReportes(){   //muestro vista para hacer la busqueda de personas
        $profesion= Profesion::all();
        return view("secretaria.reportes", compact("profesion"));
    }

    public function showVistaDatatable(){  //muestro via de tabla datatable
        return view("secretaria.ReportesTabla");
    }
    

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($campo)  //busco las coincidencias para mostrar en la busqueda
    {
      

        $person = DB::table("personas")
        ->select(DB::raw('id, CONCAT(nombres, " ", apellidos) as nombreCompleto, identificacion '))
        ->WhereRaw('CONCAT(nombres, " ", apellidos) like ?', array('%'. $campo . '%')  )
        ->orWhere('identificacion', $campo)
        ->orWhere('pastor_bautismo', 'like', "%" . $campo . "%")
        ->orWhere('estado_civil', 'like', "%" . $campo . "%")
        ->orWhere('estado', 'like', "%" . $campo . "%")
        ->orWhere('cargos', 'like', "%" . $campo . "%")
               ->get();

               return response()->json(["personas" => $person]);
    }



    public function DatosEnDatatable(){

        $datos = DB::table('personas')
        ->select(DB::raw('id, nombres,  apellidos,  IFNULL(fecha_bautismo, "No tiene" )  as fecha_bautismo, IFNULL(pastor_bautismo, "No tiene") as pastor_bautismo, IFNULL(fecha_espiritu, "No tiene") as fecha_espiritu, estado'))
              ->get();

              return DataTables($datos)->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $person= Persona::find($id);

        return response()->json(["datos" => $person]);
    }

//hermanos y hermanas bautizados
//reporte pdf 
    public function SoloBautizadosPdf()
    {
       
        $person = Persona::where([
            ['bautismo', 'si'],
            ['estado', 'activo'],
        ])
        ->orderBy("nombres")
          ->get();

          return \PDF::loadView('secretaria.pdf.pdfHermanosBautizados', compact("person"))
    ->setPaper('a4', 'portrait')
     ->stream('Sectetaría.pdf'); //si lo quiero descargar enseguida uso download(), si lo quiero

    }

    //hombres y mujeres, pero solo jovenes 12 a 35, bautizados y activos
    //con esto se pueden descargar pdf para el comite de jovenes, para tener la lista de jovenes
    //bautizados, con su apellido, fecha nacimiento  y edad.
    public function JovenesBautizadosPdf(){ 
                                      //primero resto los años: 2020-1996= 24, pero no estamos teniendo en cuenta los meses o dias,
                                      //entonces, si aun no he llegado a al mes de mayo ni al dia 27, no tengo 24 sino 23, entonces por eso
                                      //si mes actual y dia son mayor a mi mes y dia de cumpleaños le sumo 0, pero si es menor le resto 1
        $persona = DB::table('personas')
            ->select(DB::raw('nombres, apellidos, fecha_nacimiento, (YEAR(CURDATE())-YEAR(fecha_nacimiento))+ IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(fecha_nacimiento,"%m-%d"), 0 , -1)   as edad_actual, DATE_FORMAT(fecha_nacimiento,"%m") as mes, DATE_FORMAT(fecha_nacimiento,"%d") as dia'))
                     ->where([["bautismo", "si"], ["estado", "activo"]])
                     ->whereRaw('(YEAR(CURDATE())-YEAR(fecha_nacimiento))+ IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(fecha_nacimiento,"%m-%d"), 0 , -1) between 12 and 35')
                     ->orderBy("mes")
                     ->orderBy("dia")
                     ->get();
                    

                     return \PDF::loadView('secretaria.pdf.pdfJovenesBautizados', compact("persona"))
                     ->setPaper('a4', 'portrait')
                      ->stream('Sectetaría.pdf'); 
}

//solo mujeres bautizadas y activos
public function DorcasBautizadasPdf(){
    $persona = DB::table('personas')
    ->select(DB::raw('nombres, apellidos, fecha_nacimiento, (YEAR(CURDATE())-YEAR(fecha_nacimiento))+ IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(fecha_nacimiento,"%m-%d"), 0 , -1)   as edad_actual, DATE_FORMAT(fecha_nacimiento,"%m") as mes, DATE_FORMAT(fecha_nacimiento,"%d") as dia')) 
             ->where([["bautismo", "si"], ["sexo", "femenino"], ["estado", "activo"] ])
             ->orderBy("mes")
             ->orderBy("dia")
             ->get();

             return \PDF::loadView('secretaria.pdf.pdfDrocasBautizadas', compact("persona"))
             ->setPaper('a4', 'portrait')
              ->stream('Sectetaría.pdf');
}

public function caballerosPdf(){
    $caballeros = DB::table('personas')
    ->where([["bautismo", "si"], ["sexo", "masculino"], ["estado","activo"] ])
    ->get();

    return \PDF::loadView('secretaria.pdf.pdfCaballeros', compact("caballeros"))
             ->setPaper('a4', 'portrait')
              ->stream('Sectetaría.pdf');
}


public function visitasPdf(){
    $persona = DB::table('personas')
    ->select(DB::raw('nombres, apellidos,  direccion_residencia, telefono, fecha_nacimiento,  (YEAR(CURDATE())-YEAR(fecha_nacimiento))+ IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(fecha_nacimiento,"%m-%d"), 0 , -1)   as edad_actual'))
    ->where([["bautismo", "no"], ["estado", "asistente"]])
    ->get();

    return \PDF::loadView('secretaria.pdf.pdfVisitas', compact("persona"))
             ->setPaper('a4', 'landscape')
              ->stream('Sectetaría.pdf');
}


public function MiembrosSinEPdf(){
    $persona = DB::table('personas')
    ->select(DB::raw('nombres, apellidos,  direccion_residencia, telefono, fecha_nacimiento,  (YEAR(CURDATE())-YEAR(fecha_nacimiento))+ IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(fecha_nacimiento,"%m-%d"), 0 , -1)   as edad_actual'))
    ->where([["bautismo", "si"], ["espiritu", "no"],["estado", "activo"]])
    ->get();

    return \PDF::loadView('secretaria.pdf.pdfBautiSinE', compact("persona"))
             ->setPaper('a4', 'portrait')
              ->stream('Sectetaría.pdf');
}


public function cantidad(){
        
              
        $total = Persona::where([   //cantidad de miembros de la iglesia
            ['bautismo', 'si'],
            ['estado', 'activo'],
        ])->count();

    $cantidad = DB::table('personas')    //cantidad miembros hombres y miembros mujeres 
            ->select(DB::raw('sexo, count(*) as cantidad'))
                     ->where([["bautismo", "si"], ["estado", "activo"]])
                     ->groupBy('sexo')
                     ->get();

    $visitas=  DB::table('personas')  //cantidad de visitas
             ->where([["bautismo", "no"], ["estado", "asistente"]])
             ->count();

     $BautizadosSinEspiritu=  DB::table('personas')   //cantidad de miembros sin el espiritu santo
                      ->where([["bautismo", "si"],["espiritu", "no"], ["estado", "asistente"]])
                      ->count();


                //cantidad de miembros jovenes                                  
        $CantidadJovenes = DB::table('personas')
        ->select(DB::raw('(YEAR(CURDATE())-YEAR(fecha_nacimiento))+ IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(fecha_nacimiento,"%m-%d"), 0 , -1)   as edad_actual'))
                 ->where([["bautismo", "si"], ["estado", "activo"]])
                 ->whereRaw('(YEAR(CURDATE())-YEAR(fecha_nacimiento))+ IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(fecha_nacimiento,"%m-%d"), 0 , -1) between 12 and 35')
                 ->count();
                 
   return response()->json(["total" => $total, "cantidadHM" => $cantidad, "cantidadJovenes" => $CantidadJovenes, "bautizadosSinEspiritu" => $BautizadosSinEspiritu, "visitas" => $visitas]);

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
        $datos = DB::table('personas')
        ->where("id", $id)
        ->update(['nombres' => $request->nombresP, "apellidos" => $request->apellidosP,
        "lugar_nacimiento"=> $request->lugarN, "fecha_nacimiento" => $request->fechaNacP,
        "sexo" => $request->sexoP, "identificacion" => $request->identificacionP, "direccion_residencia" => $request->direccionP,
        "correo"=>$request->correoP, "telefono" =>$request->telefonoP, "estado_civil" =>$request->estadoCiviP,
        "nom_conyugue" => $request->pareja, "cant_hijos" =>$request->cantidadHijoP, "nombre_hijos" =>$request->nombreHijosP,
         "bautismo" => $request->bautismoP, "fecha_bautismo" =>$request->fechaBautiP, "pastor_bautismo" => $request->nombrePastorP,
         "espiritu" =>$request->EspirituS, "fecha_espiritu" =>$request->fechaE, "cargos" => $request->cargosServicio,
         "estado" =>$request->estadoP,"profesion_id" => $request->profesionP 
        
        ]);


        return response()->json(["mensaje" => "Datos Actualizados"]);
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
