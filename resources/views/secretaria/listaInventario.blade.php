@extends('layouts.layoutSecre')

@section('content')
<div class="container">

    <table class="table table-borderless">
        <thead>
          <tr>
           
            <th scope="col">Nombre</th>
            <th scope="col">cantidad</th>
            <th scope="col">observacion</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($existencias as $item)
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            </tr>
        @endforeach
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
</div>
@endsection