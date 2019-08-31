@extends('layouts.layoutAdmin')

@section('css')
<link href="{{ asset('css/app/user.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

<div class="mb-3 boton-agregar">
<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModalScrollable" >  
<i class="material-icons"> person_add </i>
</button>
</div>

<table class="table">
  <thead class="thead-dark">
    <tr>
     
      <th scope="col">Usuario</th>
      <th scope="col">Email</th>
      <th scope="col">Rol</th>
    
    </tr>
  </thead>

  <tbody>
      
  @foreach ($users as $user)
  <tr>
      <td>{{ $user->nom_usuario }}</td>
      <td>{{ $user->email }}</td>
    <td> {{$user->role->nombre}}  </td>

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
      <div class="modal-body">
      <form>
    <div class="form-group">
    <label for="exampleInputPassword1">Nombre Usuario</label>
    <input type="text" class="form-control" id="nom" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="pass" placeholder="Password">
  </div>
  <div class="form-group">
  <label for="exampleInputPassword1">Confirme Contraseña</label>
  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
         </div>
  
   </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-lg">Guardar</button>
      </div>
    </div>
  </div>
</div>


</div>
@endsection