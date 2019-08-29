@extends('layouts.layoutAdmin')

@section('content')
<div class="container">
    
<div class="mb-3">
  USUARIOS
</div>
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
  
  
  <button type="submit" class="btn btn-primary btn-lg px-5">Guardar</button>
</form>
    
</div>
@endsection