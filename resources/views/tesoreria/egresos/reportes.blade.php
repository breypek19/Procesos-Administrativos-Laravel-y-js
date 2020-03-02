@extends('layouts.layoutTeso')

@section('reporteEgreso')
<script type="text/javascript" src="{{ asset('js/tesor/reportEgreso.js') }}" defer></script>
@endsection


@section('content')
<div class="container mt-5">

   <h2 class="text-center">REPORTES <strong> EGRESOS</strong></h2>
   <div id="fil" class="text-white bg-light font-weight-bold text-center"  style="width: 10rem;"></div>

   

   <br>
   <br>
   <h3>Opciones Para Filtrar</h3>

   <div class="row mt-3 ">
    
    <div class="mt-2 col-sm-6 col-md-3">
   <select id="rubE" class="select-css">
<option>Elige una opcion</option>
@foreach($rubros as $rubro)
<option  value="{{$rubro->id}}">{{strtoupper($rubro->nombre)}}</option>
@endforeach
   </select>
</div>


<div class="mt-2 col-sm-6 col-md-3">
   <select id="detallE" class="select-css">
       <option>Sin opciones</option>
   </select>
</div>

<div class="mt-2 col-sm-6 col-md-3">
   <select id="filtañoEgreso" class="select-css">
       <option value="0" >Filtre por año</option>
   @foreach($listaA as $lista)
<option  value="{{$lista->año}}">{{strtoupper($lista->año)}}</option>
@endforeach
   </select>
</div>

<div class="mt-2 col-sm-6 col-md-3">
   <select id="mesesE" class="select-css">
       <option value="0" >Filtre por Mes</option>
   @foreach($listaM as $list)
<option  value="{{$list->mes}}">
@switch($list->mes)
    @case("01")
    {{strtoupper("ENERO")}}
        @break

    @case("02")
    {{strtoupper("FEBRERO")}}
        @break
     @case("03")
     {{strtoupper("MARZO")}}
        @break
        @case("04")
        {{strtoupper("ABRIL")}}
        @break
        @case("05")
        {{strtoupper("MAYO")}}
        @break
        @case("06")
        JUNIO
        @break
        @case("07")
        JULIO
        @break
        @case("08")
        AGOSTO
        @break
        @case("09")
        SEPTIEMBRE
        @break
        @case("10")
        OCTUBRE
        @break
        @case("11")
        NOVIEMBRE
        @break
        @case("12")
       Diciembre
        @break

  
        
@endswitch
</option>
@endforeach
   </select>
</div>

</div>


<div class="d-flex justify-content-end mt-5" >
    
<div  class="p-2 font-weight-bold"> 
TOTAL:
</div>
    <input id="tot" class="bg-warning ml-2 border-0 text-center font-weight-bold  py-2"  type="text" value=0 />
</div>






<div class="mt-5">
   
<table id="reportEg" class="table " style="width:100%">
<thead class="thead-dark ">
            <tr>
                
                <th id="deta-en">DETALLE</th>
                <th>TOTAL INGRESO</th>
                <th>MES</th>
                <th>AÑO</th>   
            </tr>
            
        </thead>
       

        <tr class="str">
            <td class="sin">
                <strong>Sin resultados</strong>
</td>
<td class="sin"></td>
<td class="sin"></td>
<td class="sin"></td>
</tr>
 
         
    </table>


</div>


@endsection