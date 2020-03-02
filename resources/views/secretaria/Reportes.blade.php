@extends('layouts.layoutSecre')

@section('SecreReportes')
<script src="{{ asset('js/secre/reportes.js') }}" defer></script>
@endsection

@section('CssReportes')
<link href="{{ asset('css/secre.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

  <h3 class="mt-5">Busqueda relacionada</h3>
  
<div class="mensaje">
</div>

<div class="row mt-3  repo justify-content-center">

  <div class="div1 col-12 ml-3 ml-sm-0 col-sm-10 col-md-7  col-lg-7 border bg-white ">
    
      <div class="d-flex my-2 my-lg-0 align-items-center p-2">
    
          <i class="material-icons text-info"> search</i>
    
          <input class="form-control bu  border-0" type="text" id="inputBu" placeholder="Buscar.." >
      
      </div>

  </div>



</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="mensajePersona"></div>
      <div class="modal-body">
        <form id="formo">
          <input type="hidden" id="id_persona" />
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nombre">Nombres</label>
              <input type="text" class="form-control" id="nombres" autofocus/>
            </div>
            <div class="form-group col-md-6">
              <label for="apellidos">Apellidos</label>
              <input type="text" class="form-control" id="apellidos" >
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">Lugar de nacimiento</label>
              <input type="text" class="form-control" id="lugar">
            </div>
            <div class="form-group col-md-4">
              <label for="fechaNac">Fecha Nacimiento</label>
              <input type="date" class="form-control" id="fechaNac"/>
            </div>
            <div class="form-group col-md-2">
              <label for="fechaNac">Sexo</label>
        <select name="" id="sexo" class="form-control">
          <option value="masculino">Masculino</option>
          <option value="femenino">Femenino</option>
        </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Identificacion</label>
              <input type="text" class="form-control" id="identificacion">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Direccion residencia</label>
            <input type="text" class="form-control" id="direccion" placeholder="B. Escolar">
          </div>
          <div class="form-group">
            <label for="inputAddress2">Correo Actual</label>
            <input type="email" class="form-control" id="correo" placeholder="ipuc@gmail.com">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">Telefono</label>
              <input type="text" class="form-control" id="telefono">
            </div>
            <div class="form-group col-md-4">
              <label for="EstadoCivil">Estado  Civil</label>     <!-- si es soltero quito el campo conyugue  -->
              <select id="EstadoCivil" class="form-control">
                <option value="casado" >Casado</option>
                <option value="soltero">Soltero</option>
                
              </select>
            </div>
            <div class="form-group col-md-4" id="conyu">
              <label for="gridCheck">
                Conyugue
              </label>
              <input class="form-control" type="text" id="conyug">
          </div>
        </div>
        
        <div class="form-row hijos">
            <div class="form-group col-md-3 ">       <!-- si la cantidad de hijos >0 agrego un campo para escribir los nombres de los hijos  --->
              <label for="inputZip">Cantidad de hijos</label>
              <input type="number" min="0" id="cantidadH" class="form-control"/>
            </div>
        
          </div>
        
            <div class="form-group col-md-4 ">
              <label for="inputZip">Profesion u Oficio</label>
              <select class="form-control" id="prof">
                <option value="" id="seleccione" >Seleccione un Oficio...</option>
               
                @foreach ($profesion as $item)
                <option value="{{$item->id}}">{{$item->nombre}}</option>   
                @endforeach
             
             <option id="otro" value="0">Otro...</option>
              </select>
            </div>
          
        
            <div class="form-row bauti mt-5">
                                                    <!-- si bautismo es si, pongo campo fecha para el bautismo, pastor que lo bautizo -->
              <div class="form-group col-md-3">
                <label for="inputCity" class="mx-3">Bautismo</label>
                <input type="radio" class="bautis"  name="bautismo" value="si" > Si
                <input type="radio" class="ml-3 bautis"  name="bautismo"   value="no"> No
              </div>
        
             
               <!-- si bautismo es si, aqui pongo campo fecha y text para el pastor -->
          </div>
        
        
        
          <div class="form-row espiri mt-4">
               <!-- si espiritu santo es si, pongo campo fecha para el espritiu santo -->
            <div class=" form-group col-md-3">
              <label for="inputCity" class="mx-3">Espiritu Santo</label>
              <input type="radio" class="espirituS"  name="espiritu"  value="si" > Si
              <input type="radio" class="ml-3 espirituS"   name="espiritu" value="no"> No
            </div>
        
            <!-- campo fecha espiriu santo, si lo recibio --->
        </div>
        
        <div class="form-row">
        
          <div class="form-group mt-4  col-md-5">
            <label for="" >Estado</label> 
            <select name="" id="estado" class="form-control">
              <option value="activo" > Activo</option>
                <option value="traslado" >Traslado</option>
                <option value="apartado" >Apartado</option>
                <option value="asistente" >Asistente</option>
                  <option value="fallecido" >Fallecido</option>
                  <option value="ausente" >Ausente</option>
                   
            </select>
          </div>
        
          <div class="form-group mt-4 carg col-md-6">
            <label for="" >Cargos (Describa los cargos que ha tenido)</label> 
            <textarea class="form-control"  id="cargos" rows="2"></textarea>
          </div>
        
        </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="actualizar" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Profesion U Oficio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row ml-2">
    <label class="col-sm-2 col-form-label" for="rubroE">OFICIO</label>
    <div class="col-sm-6 col-md-6"> 
    <input type="text" class="form-control" id="oficio" autofocus="autofocus">
</div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="guardOficio" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>


</div>
@endsection