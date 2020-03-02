@extends('layouts.layoutTeso')

@section('diezmo')
<script type="text/javascript" src="{{asset('js/tesor/diezmo.js')}}" defer></script>
@endsection


@section('content')
<div class="container mt-5">

<h2>LIQUIDACION DIEZMO</h2>
<br>
<br>

<h3>DENOMINACIONES</h3>



<div class="row border p-4">

<div clas="col-xs-12 col-sm-12 col-md-12">

<div class="d-flex flex-column">
 <div class="d-flex fila"> 
   <div class="mx-2 numero ">
    <input  type="text"  value="100.000"  readonly/>
      X 
   </div>

   <div class="mx-2 cantidad"> 
     <input id="cien"  value=0 type="text"/>
      =
    </div>

   <div class="total">
    <input  readonly   type="text"/> 
   </div>

  </div>
{{-- hasta aqui primera fila ---}}


<div class="d-flex py-2 my-2 fila"> 
   <div class="mx-2">
    <input  type="text" value="50.000" readonly/>
      X 
   </div>

   <div class="mx-2 cantidad"> 
     <input id="cincuenta" value=0 type="text"/>
      =
    </div>

   <div class="total">
    <input readonly   type="text"/> 
   </div>

  </div>
  {{-- hasta aqui segunda fila ---}}


  <div class="d-flex my-2 fila"> 
   <div class="mx-2">
    <input  type="text" value="20.000" />
      X 
   </div>

   <div class="mx-2 cantidad"> 
     <input id="veinte" value=0 type="text"/>
      =
    </div>

   <div class="total">
    <input readonly type="text"/> 
   </div>

  </div>
  {{-- hasta aqui tercera fila ---}}


  <div class="d-flex my-2 fila "> 
   <div class="mx-2">
    <input type="text" value="10.000" readonly />
      X 
   </div>

   <div class="mx-2 cantidad"> 
     <input id="diez" value=0 type="text"/>
      =
    </div>

   <div class="total">
    <input readonly  type="text"/> 
   </div>

  </div>
  {{-- hasta aqui cuarta fila ---}}

  <div class="d-flex my-2 fila "> 
   <div class="mx-2">
    <input type="text" value="5.000" readonly />
      X 
   </div>

   <div class="mx-2 cantidad"> 
     <input id="cinco" value=0 type="text"/>
      =
    </div>

   <div class="total">
    <input readonly type="text"/> 
   </div>

  </div>
  {{-- hasta aqui quinta fila ---}}
  

  <div class="d-flex my-2 fila "> 
   <div class="mx-2">
    <input type="text" value="2.000" readonly />
      X 
   </div>

   <div class="mx-2 cantidad"> 
     <input id="dos" value=0 type="text"/>
      =
    </div>

   <div class="total">
    <input readonly type="text"/> 
   </div>

  </div>
  {{-- hasta aqui sexta fila ---}}


  <div class="d-flex my-2 fila"> 
   <div class="mx-2">
    <input type="text" value="1.000" readonly/>
      X 
   </div>

   <div class="mx-2 cantidad"> 
     <input id="mil" value=0 type="text"/>
      =
    </div>

   <div class="total">
    <input readonly type="text"/> 
   </div>

  </div>
  {{-- hasta aqui sexta fila ---}}
  <div>
  Monedas:   <input  id="monedas" value=0  type="text" />
</div>

</div>

</div>

<div>

</div>

<div class="col-xs-12 col-sm-12 col-md-5 ml-4 rounded border p-2" >
<h3 class="text-center mb-4">DESCUENTOS</h3>
   <div class="row "  >
    <div class="col-sm-4 p-3">

  <label>Diezmo Bruto: </label>
   </div>
<div class="col-sm-7     p-2">
  <input  id="sum-total" class=" p-3  text-center border-0  bg-warning rounded " readonly type="text">
</div>
</div>


<div class=" row mt-5 ">
<div class="col-sm-4">
<label>Fondo Nacional : %</label>
</div>
<div class="col-sm-2 my-2    " >
<input style="width:45px" value="21" class=" bg-info text-center rounded  p-2 border-0" type="text" id="porcentajeNac" />
</div>

<div class="col-sm-1 my-1 ">
<label style="font-size:30px" >=</label>
</div>
<div class="col-sm-2 m-2">
<input style="width:130px"  class="p-2  text-center bg-secondary  text-white rounded  border-0" type="text" id="fondoN"  readonly/>
</div>
</div>


<div class="row mt-2">
    <div class="col-sm-7">
        Subtotal:
</div>
<div class="col-sm-4 ">
<input style="width:120px" class=" text-center   p-1 " type="text" id="subtotal1" readonly/>
</div>

</div>


<div class=" row mt-5">
<div class="col-sm-4">
<label >Fondo local : %</label>
</div>
<div class="col-sm-2 my-2 ">
<input style="width:45px" value="16" class=" text-center bg-info  rounded  p-2 border-0" type="text" id="porcentajeLocal" />
</div>

<div class="col-sm-1 my-1 ">
<label style="font-size:30px" >=</label>
</div>

<div class="col-sm-2 m-2">
<input  style="width:130px" class="p-2 text-center text-white  rounded bg-secondary   border-0" type="text" id="fondoL" readonly />
</div>
</div>

<div class="row mt-2">
    <div class="col-sm-7">
        Subtotal:
</div>
<div class="col-sm-4 ">
<input style="width:120px" class=" text-center   p-1 " type="text" id="subtotal2" readonly />
</div>

</div>



<div class=" row mt-5">
<div class="col-sm-4">
<label >Ahorro programado : %</label>
</div>
<div class="col-sm-2 my-2 ">
<input style="width:45px" value="5" class=" text-center bg-info  rounded  p-2 border-0" type="text" id="porcenAhorro" />
</div>

<div class="col-sm-1 my-1 ">
<label style="font-size:30px" >=</label>
</div>

<div class="col-sm-2 m-2">
<input  style="width:130px" class="p-2 text-center text-white  rounded bg-secondary   border-0" type="text" id="ahorro" readonly />
</div>
</div>

<div class="row mt-2">
    <div class="col-sm-7">
        Subtotal:
</div>
<div class="col-sm-4 ">
<input style="width:120px" class=" text-center   p-1 " type="text" id="subtotal3" readonly/>
</div>

</div>

<div class=" row mt-5">
<div class="col-sm-4 p-3">
<label>Neto Pastor =</label>
</div>
<div class="col-sm-5 p-2">
<input class=" bg-danger text-center text-white p-3 border-0  rounded " type="text" id="neto"  readonly/>
</div>
</div>


</div>

</div>


</div>



<div class="container">
<div class="form-group mt-5 row">
    <label class="col-sm-2 col-form-label" for="Rubro">Rubro</label>
    <div class="col-sm-12 col-md-6">
    <select class="form-control"  id="rubro">
    <option value="">Selecciona una opcion</option>
     @foreach ($rubrosm as $rubr)
    <option value="{{$rubr->id}}">{{ strtoupper($rubr->nombre)}}</option>
      @endforeach
    </select>
</div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="detalle">Detalle Rubro</label>
    <div class="col-sm-12 col-md-6">
    <input type="text"  class="form-control"  id="detalle">
</div>
  </div>

  <input  type="hidden" name="id_detalle" id="id_detalle">

  <div class="form-group row">
    <label  for="cantidad" class="col-sm-2  col-form-label">Cantidad</label>
    <div class="col-sm-6 col-md-6">
    <input type="text"  class="form-control"  id="cantidad" readonly>
    </div>
  </div>

  <input type="hidden"   id="cantidadNeto" >

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label" for="fecha">Fecha</label>
    <div class="col-sm-6 col-md-6">
    <input type="date"  class="form-control" id="fecha" >
</div>
  </div>

  <div class="form-group row">
    <label  for="comentario" class="col-sm-2  col-form-label">Comentario</label>
    <div class="col-sm-12 col-md-6">
    <textarea class="form-control"  id="comentario" rows="2"></textarea>
    </div>
  </div>

</div>

<div style="margin: 0 auto; width: 140px"  class="mt-4">
<button type="button" id="liquidar" class="btn btn-success btn-lg">LIQUIDAR</button>
</div>

</div>
@endsection