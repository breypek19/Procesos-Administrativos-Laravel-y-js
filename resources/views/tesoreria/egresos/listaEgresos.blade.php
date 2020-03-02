@extends('layouts.layoutTeso')

@section('datatablesEgresosjs')
<script type="text/javascript" src="{{asset('js/datatables.min.js')}}" defer></script>
<script type="text/javascript" src="{{ asset('js/tesor/movEgresos.js') }}" defer></script>
@endsection


@section('datatablescss')   
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
   <h2>EGRESOS</h2>
   <br>
   <br>
<table id="egresos" class="cell-border" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUBRO</th>
                <th>DETALLE</th>
                <th>CANTIDAD</th>
                <th>DESCRIPCION</th>
                <th>DIA</th>
                <th>MES</th>
                <th>AÑO</th>
                <th>Action</th>
                
                
            </tr>
        </thead>
        
    </table>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
  
<form id="actuaEgresos" method="POST">
    @csrf
    @method('PUT')
      <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="rubroEdit">Rubro</label>
    <div class="col-sm-12 col-md-6">
    <select class="form-control" name="rubroE" id="rubroEgresoEdit">
    <option value="">Selecciona una opcion</option>
    @foreach ($rubros as $item)
    <option value="{{$item->id}}">{{$item->nombre}}</option>
    @endforeach
    </select>
</div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="detalleEdit">Detalle Rubro</label>
    <div class="col-sm-12 col-md-6">
    <input type="text"  class="form-control"   id="detalleEgresoEdit">
</div>
  </div>

  <input  type="hidden" name="id_detalleE" id="id_detalleEgresoEdit">
 

  <div class="form-group row">
    <label  for="cantidad" class="col-sm-2  col-form-label">Cantidad</label>
    <div class="col-sm-6 col-md-6">
    <input type="text"  class="form-control" name="cantidadE" id="cantidadEgresEdit">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label" for="fecha">Fecha</label>
    <div class="col-sm-6 col-md-6">
    <input type="date"  class="form-control" name="fechaE" id="fechaEg" >
</div>
  </div>

  <div class="form-group row">
    <label  for="comentario" class="col-sm-2  col-form-label">Comentario</label>
    <div class="col-sm-12 col-md-6">
    <textarea class="form-control" name="comentarioE"  id="comentarioEgresoEdit" rows="2"></textarea>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Actualizar</button>

</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

</div>
@endsection