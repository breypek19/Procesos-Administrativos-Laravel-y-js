@extends('layouts.layoutTeso')

@section('datatablesjs')
<script type="text/javascript" src="{{asset('js/datatables.min.js')}}" defer></script>
<script type="text/javascript" src="{{ asset('js/tesor/mov.js') }}" defer></script>
@endsection


@section('datatablescss')   
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
   <h2>INGRESOS</h2>
   <br>
   <br>
   <div class="table-responsive">
<table id="ingresos" class="cell-border" style="width:100%">
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
   </div>


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
        
  
<form id="actua" action="" method="POST">
    @csrf
    @method('PUT')
      <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="rubroEdit">Rubro</label>
    <div class="col-sm-12 col-md-6">
    <select class="form-control" name="rubro" id="rubroEdit">
    <option value="">Selecciona una opcion</option>
    @foreach($rubros as $rubro)
<option  value="{{$rubro->id}}">{{strtoupper($rubro->nombre)}}</option>
@endforeach
    </select>
</div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="detalleEdit">Detalle Rubro</label>
    <div class="col-sm-12 col-md-6">
    <input type="text"  class="form-control"   id="detalleEdit">
</div>
  </div>

  <input  type="hidden" name="id_detalle" id="id_detalleEdit">
 

  <div class="form-group row">
    <label  for="cantidad" class="col-sm-2  col-form-label">Cantidad</label>
    <div class="col-sm-6 col-md-6">
    <input type="text"  class="form-control" name="cantidad" id="cantidadEdit">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label" for="fecha">Fecha</label>
    <div class="col-sm-6 col-md-6">
    <input type="date"  class="form-control" name="fecha" id="fecha" >
</div>
  </div>

  <div class="form-group row">
    <label  for="comentario" class="col-sm-2  col-form-label">Comentario</label>
    <div class="col-sm-12 col-md-6">
    <textarea class="form-control" name="comentario"  id="comentarioEdit" rows="2"></textarea>
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