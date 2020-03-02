@extends('layouts.layoutAdmin')

@section('content')
<div class="container">
    
<div class="mb-3">

</div>

    <form>
    <div class="form-group">
    <label for="exampleInputPassword1">Nombre Usuario</label>
    <input type="text" class="form-control" value="{{$users->nom_usuario}}" id="nom_us" disabled >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" value="{{$users->email}}" id="email_u" aria-describedby="emailHelp" >
  </div>


  <div class="form-group">
  <label for="exampleFormControlSelect1">Rol Usuario</label>
   <select class="form-control" id="selec_us">
   @foreach($roles as $rol)
   <option value="{{$rol->id}}">{{$rol->nombre}}</option>
   @endforeach
   </select>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="pass_u" placeholder="Password">
  </div>
  <div class="form-group">
  <label for="exampleInputPassword1">Confirme Contraseña</label>
  <input id="password-c" type="password" class="form-control" name="password_confir" required autocomplete="new-password">
         </div>
  
         <input id="id_usu" name="prodId" type="hidden" value="{{$users->id}}">
  
</form>
<button id="guard" class="btn btn-primary btn-lg px-5">Guardar</button>
    
</div>
@endsection