@extends('layouts.layoutAdmin')

@section('content')
<div class="container">

<div class="mb-4 boton-agregar">
<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModalScrollable" >  
<i class="material-icons"> person_add </i>
</button>
</div>

<table class="table  table-hover">
  <thead >
    <tr>
     
      <th scope="col">Usuario</th>
      <th scope="col">Email</th>
      <th scope="col">Rol</th>
      <th class="text-center" scope="col">Acción</th>
     
    
    </tr>
  </thead>

  <tbody>
      
  @foreach ($users as $user)
 <tr>
    <td>{{ $user->nom_usuario }}</td>
   <td>{{ $user->email }}</td>
    <td> {{$user->role->nombre}}  </td>
    <td class="text-center">
    <a class="mr-3 editar" href="{{route('users.edit', $user->id )}}"><i class="material-icons">create</i></a>
    <a class="eliminar"  data-id="{{$user->id}}" href=""><i  class="material-icons" >delete</i></a>
     </td>
    
@endforeach
</tr>

</tbody>

</table>
    

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-warning mt-4" id="mensaje-servidor" role="alert">
  
</div>
      <div class="modal-body">
      <form>
    <div class="form-group">
    <label for="exampleInputPassword1">Nombre Usuario</label>
    <input type="text" class="form-control" id="nom" placeholder="Usuario">
  </div>
  <div class="alert alert-secondary" id="nom_usuario" role="alert">
  
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="alert alert-warning alert-dismissible fade show" id="emai" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
 

  <div class="form-group">
  <label for="exampleFormControlSelect1">Rol Usuario</label>
   <select class="form-control" id="selec">
   @foreach($roles as $rol)
   <option value="{{$rol->id}}">{{$rol->nombre}}</option>
   @endforeach
   </select>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="pass" placeholder="Password" >
  </div>

  <div class="alert alert-warning mb-3" id="password" role="alert">
  
</div>


  <div class="form-group">
  <label for="exampleInputPassword1">Confirme Contraseña</label>
  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
  <div class="alert alert-primary mt-2"  id="confirmacion" role="alert">

</div>

</div>
<div class="alert alert-danger   mt-3" id="dang" role="alert">
         </div>
    
   </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="bton-guardar" class="btn btn-primary btn-lg">Guardar</button>
      </div>
    </div>
  </div>
</div>


</div>
@endsection