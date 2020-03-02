@extends('layouts.layoutSecre')

@section('asistenciaJs')
<script src="{{ asset('js/jquery-nao-calendar.js')}}" defer></script>
<script src="{{ asset('js/jquery-pseudo-ripple.js')}}" defer></script>
<script src="{{ asset('js/calendario.js')}}" defer></script>
@endsection

@section('asistenciaCss')   
<link href="{{ asset('aicon/style.css') }}" rel="stylesheet">
<link href="{{ asset('csscalendario/jquery-nao-calendar.css') }}" rel="stylesheet">
<link href="{{ asset('csscalendario/calendario.css') }}" rel="stylesheet">

@endsection


@section('content')
<br>
<br>
<br>
<div class="container bg-white mt-5">
 <div>
<h2>Calendario De Asistencias</h2>
 </div>

    <div class="myCalendar">

    </div>


 

    
<div class="modal fade" id="modalAsistencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Asistencia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <div class="form-group row fec ">
        
      <label class="col-sm-2 col-form-label" for="rubroE">Fecha</label>
      <div class="col-sm-5 col-md-5"> 
      <input type="text" class="form-control" id="fecha" autofocus="autofocus" disabled>
    </div>

    

        </div>

        
     

  <div class="form-group row herma">
    <label class="col-sm-2 col-form-label" for="oficio">Hermanos</label>
    <div class="col-sm-5 col-md-5"> 
    <input type="text" class="form-control asis" id="hermanos" autofocus="autofocus">
</div>
</div>

<div class="form-group row herman">
    <label class="col-sm-2 col-form-label" for="oficio">Hermanas</label>
    <div class="col-sm-5 col-md-5"> 
    <input type="text" class="form-control asis" id="hermanas" autofocus="autofocus">
</div>
</div>

<div class="form-group row vis">
    <label class="col-sm-2 col-form-label" for="visitas">visitas</label>
    <div class="col-sm-5 col-md-5"> 
    <input type="text" class="form-control asis" id="visitas" autofocus="autofocus">
</div>
</div>

<div class="form-group row niñ">
    <label class="col-sm-2 col-form-label" for="niños">Niños y Adolescentes</label>
    <div class="col-sm-5 col-md-5"> 
    <input type="text" class="form-control asis" id="niños" autofocus="autofocus">
</div>
</div>




   

   
        </div>

        <div class="modal-footer">
            <div id="success"></div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="guardarAsis" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection