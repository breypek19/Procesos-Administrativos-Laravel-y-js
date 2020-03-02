<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RequestUser;

class UsuariosControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
{
    $this->middleware('auth');
    $this->middleware( 'admin');
}

    public function index()
    {
       $user= User::all();
       $roles= Role::all();
       return view("admin.usuarios", ['users' => $user, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.userCreate");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUser $request)
    {

        $validated = $request->validated();

          $user = new User; //primera forma 
   
      //  $rol=Role::find($request->rol_us); //segunda forma...hago esto para basarme en la relacion

      // 1.forma: le paso el id del rol normalmente
    
        $user->nom_usuario = $request->nom_usuario;
        $user->email=$request->email_us;
        $user->password= bcrypt($request->passw);
        $user->role_id=$request->rol_us;  //le paso directamente el id del rol

        $user->save();
        return response()->json("Usuario registrado con exito");
        
/////////////////////////////////////////////////////////////////////////////////77



//2.forma: me baso en la relacion. para que esto funcione bien con el metodo create([]) debo poner los
//atributos asignables a masa. Esto lo hago con la propiedad $fillable en el modelo User
/*
        $usuario=$rol->users()->create([
            "nom_usuario" => $request->nom_usuario,
            "email"=> $request->email_us,
             "password" => bcrypt($request->passw),
        ]);

        return "Usuario registrado con exito";
*/
    

       



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
        $rol=Role::all();
       $user=User::find($id);

       return view("admin.userEditar", ['users' => $user, 'roles' =>$rol]);
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
        $user = User::find($id);
        $user->email=$request->email_usuario;
        $user->password=$request->password_usu;
        $user->role_id=$request->rol_us;
        $user->save();
        
        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        return "Usuario Eliminado";
    }
}
