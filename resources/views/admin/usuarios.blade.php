@extends('layouts.layoutAdmin')

@section('content')
<div class="container">

<div>


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