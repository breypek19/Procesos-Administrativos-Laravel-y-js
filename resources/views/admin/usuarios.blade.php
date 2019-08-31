@extends('layouts.layoutAdmin')

@section('css')
<link href="{{ asset('css/app/user.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

<div class="mb-3 boton-agregar">
<button type="button" class="btn btn-danger">  
<a href=""><i class="material-icons"> person_add </i></a>
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
    

</div>
@endsection