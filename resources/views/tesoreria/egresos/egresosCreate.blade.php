@extends('layouts.layoutTeso')

@section('egreso')
<script src="{{ asset('js/tesor/egreso.js') }}" defer></script>
@endsection

@section('content')
<div class="container mt-5"> 
  

<div class="d-flex p-2" >

<div class="px-2">
    <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Agregar Rubro
    <i class="material-icons ">
add_circle
</i>
    </button>
</div>

<div class="px-2">
    <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDetalle">Detalle

    <i class="material-icons">
add_comment
</i>
    </button>

</div>

</div>




<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear Rubro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row ml-2">
    <label class="col-sm-2 col-form-label" for="rubroE">Rubro</label>
    <div class="col-sm-6 col-md-6"> 
    <input type="text" class="form-control" id="rubroE" autofocus="autofocus">
</div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="guardRubro" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear Detalle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row ml-2">
    <label class="col-sm-2 col-form-label" for="detalleE">Detalle</label>
    <div class="col-sm-6 col-md-6"> 
    <input type="text" class="form-control" id="detalleE" autofocus="autofocus" >
</div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="guarDetalle" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<h3 class="mt-5 text-danger">Egreso</h3>
<div class="row">
<div class="col-sm-9 col-md-7 border p-5  ">
<form>
    <div class="form-group row">
    <label class="col-sm-2 col-md-3 col-form-label" for="Rubro">Rubro</label>
    <div class="col-sm-12 col-md-8">
    <select class="form-control"  id="rubro">
    <option value="">Selecciona una opcion</option>
    
      @foreach ($rubrosE as $item)
    <option value="{{$item->id}}">{{strtoupper($item->nombre)}}</option>
          @endforeach
    </select>
</div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-md-3 col-form-label" for="detalle">Detalle Rubro</label>
    <div class="col-sm-12 col-md-8">
    <input type="text"  class="form-control"  id="detalleEgreso">
</div>
  </div>

  <input  type="hidden" name="id_detalle" id="id_detalleE">

  <div class="form-group row">
    <label  for="cantidadE" class="col-sm-2 col-md-3 col-form-label">Cantidad</label>
    <div class="col-sm-12 col-md-8">
    <input type="text"  class="form-control"  id="cantidadE">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-md-3 col-form-label" for="fecha">Fecha</label>
    <div class="col-sm-12 col-md-8">
    <input type="date"  class="form-control" id="fechaE" >
</div>
  </div>

  <div class="form-group row">
    <label  for="comentario" class="col-sm-2 col-md-3  col-form-label">Comentario</label>
    <div class="col-sm-12 col-md-8">
    <textarea class="form-control"  id="comentario" rows="2"></textarea>
    </div>
  </div>

  
 
</form>

</div>

<div class="col-sm-12 col-md-2 lista mt-3 ">
  <div class="card" style="width: 18rem;">
    
      
  
  </div>
</div>


 
    <div class="col-sm-4 col-md-5 mt-4">
      <button class="btn btn-outline-success btn-lg"  id="egreso_general">Guardar</button>
    </div>




</div>

</div>
@endsection