@extends('layouts.layoutTeso')

@section("ingreso")
<script src="{{ asset('js/tesor/ingreso.js') }}" defer></script>
@endsection

@section('content')
<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Ingresos</li>
    </ol>   
  </nav>  
  
<div class="row  mt-5">

  
     <div class="col-sm-12 col-md-8 p-3 m-auto">

  <ul class="nav nav-tabs show active"  id="myTab" role="tablist">
     <li class="nav-item">
    <a class="nav-link active" id="ingreso-tab" data-toggle="tab" href="#ingreso" role="tab" aria-controls="ingreso" aria-selected="true">Crear Ingresos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="rubro-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Rubro</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="detalle-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Detalle</a>
  </li>
  
</ul>
<div class="tab-content" id="myTabContent">
 
<div class="tab-pane fade show active mt-5 " id="ingreso" role="tabpanel" aria-labelledby="profile-tab">
 
  <div class="row">
  <div class="col-sm-9 col-md-7">
<form>  
    <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="Rubro">Rubro</label>
    <div class="col-sm-12 col-md-8">
    <select class="form-control"  id="rubro">
    <option value="">Selecciona una opcion</option>
     @foreach ($rubros as $rubr)
    <option value="{{$rubr->id}}">{{ strtoupper($rubr->nombre)}}</option>
      @endforeach
    </select>
</div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="detalle">Detalle Rubro</label>
    <div class="col-sm-12 col-md-8">
    <input type="text"  class="form-control"  id="detalle">
</div>
  </div>

  <input  type="hidden" name="id_detalle" id="id_detalle">

  <div class="form-group row">
    <label  for="cantidad" class="col-sm-2  col-form-label">Cantidad</label>
    <div class="col-sm-12 col-md-8">
    <input type="text"  class="form-control"  id="cantidad">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label" for="fecha">Fecha</label>
    <div class="col-sm-12 col-md-8">
    <input type="date"  class="form-control" id="fecha" >
</div>
  </div>

  <div class="form-group row">
    <label  for="comentario" class="col-sm-2  col-form-label">Comentario Ingreso </label>
    <div class="col-sm-12 col-md-8">
    <textarea class="form-control"  id="comentario" rows="2"></textarea>
    </div>
  </div>
 
</form>


  </div>

  <div class="col-sm-12 col-md-3 listaDetalles mt-3 ">
    <div class="card" style="width: 17rem;">
      
        
    
    </div>
  </div>

  <div class="col-md-5 mt-5 ml-5">
    <button type="button" id="ingreso_general" class="btn btn-success btn-lg">Guardar</button>
    
  </div>

</div>
</div>




<div class="tab-pane fade mt-4  " id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="form-group row ml-2">
    <label class="col-sm-1 col-form-label" for="rubro_solo">Rubro</label>
    <div class="col-sm-6 col-md-6"> 
    <input type="text" class="form-control" id="rubro_solo" >
</div>
  </div>
  <button id="rubroGuardar">Guardar</button>
  </div>



  <div class="tab-pane fade mt-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <div class="form-group row ">
  <label class="col-sm-2 col-form-label" for="detalle_d">Ingrese Detalle</label>
    <div class="col-sm-6 col-md-6">
    <input type="text" class="form-control" id="detalle_d" >
</div>
  </div>

  
  <button id="detalle_guardar">Guardar</button>
  </div>

  


  
</div>
        <div>
          
</div>
        
    </div>
</div>


</div>
@endsection