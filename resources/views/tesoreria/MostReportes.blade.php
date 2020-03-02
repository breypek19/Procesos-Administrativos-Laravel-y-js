@extends('layouts.layoutTeso')

@section('report')
<script type="text/javascript" src="{{ asset('js/tesor/reportIngreso.js') }}" defer></script>
@endsection

@section('estilosSelect')
<link href="{{ asset('css/tesor.css') }}" rel="stylesheet">
@endsection



@section('content')
<div class="container mt-5">

   <h2 class="text-center">REPORTE <strong> INGRESOS</strong></h2>
   <div id="fil" class="text-white bg-light font-weight-bold text-center"  style="width: 10rem;"></div>

   <div class="d-flex justify-content-end">
   <p>
  <a class="btn btn-primary" id="me" data-toggle="collapse" href="#info" role="button" aria-expanded="false" aria-controls="collapseExample">
    Informe General Mensual
  </a>
  <button  class="btn btn-primary" type="button" data-toggle="collapse" data-target="#info-meses" aria-expanded="false" aria-controls="collapseExample">
 Informe  Meses
  </button>
</p>
</div>

{{--  esto es lo que se muestra cuando le doy click en Informe.. el contenido se agrega desde js, el enlace para la descarga  --}}
<div class="collapse" id="info">
  <div class="card card-body">
  </div>
</div>

{{--  esto es lo que se muestra cunaod le doy click en informe meses, el enlace se agrega desde js --}}
<div class="collapse" id="info-meses">
  <div class="card card-body">
      <div id="form">
 Reporte de <select id="inicio">
 @foreach($listaMeses as $list)
 <option value="{{$list->mes}}">{{$list->mes}}</option>
 @endforeach
</select>

 Hasta <select id="fin">
 @foreach($listaMeses as $list)
 <option value="{{$list->mes}}">{{$list->mes}}</option>
 @endforeach
</select>
</div>
  </div>
</div>


   <br>
   <br>
   <h3>Opciones Para Filtrar</h3>
   <div class="row mt-3 ">

    <div class="mt-2  col-sm-6 col-md-3">
   <select id="rub" class="select-css">
<option>Elige una opcion</option>
@foreach($rubros as $rubro)
<option  value="{{$rubro->id}}">{{strtoupper($rubro->nombre)}}</option>
@endforeach
   </select>
</div>


<div class="mt-2 col-sm-6 col-md-3">
   <select id="detall" class="select-css">
       <option>Sin opciones</option>
   </select>
</div>

<div class=" mt-2 col-sm-6 col-md-3">
   <select id="filtaño" class="select-css">
       <option value="0" >Filtre por año</option>
   @foreach($listaAños as $lista)
<option  value="{{$lista->año}}">{{strtoupper($lista->año)}}</option>
@endforeach
   </select>
</div>

<div class="mt-2 mt-2 col-sm-6 col-md-3">
   <select id="meses" class="select-css">
       <option value="0" >Filtre por Mes</option>
   @foreach($listaMeses as $list)
<option  value="{{$list->mes}}">
@switch($list->mes)
    @case("01")
        Enero
        @break

    @case("02")
        Febrero
        @break
     @case("03")
        Marzo
        @break
        @case("04")
        Abril
        @break
        @case("05")
        Mayo
        @break
        @case("06")
       Junio
        @break
        @case("07")
       Julio
        @break
        @case("08")
       Agosto
        @break
        @case("09")
       Septiembre
        @break
        @case("10")
       Octubre
        @break
        @case("11")
    Noviembre
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
   
<table id="report" class="table " style="width:100%">
<thead class="thead-dark ">
            <tr>
                
                <th id="deta-en">DETALLE</th>
                <th>TOTAL INGRESO</th>
                <th>MES</th>
                <th>AÑO</th>   
            </tr>
            
        </thead>
       
     
        <tr>
            <td>
                <strong>Sin resultados</strong>
</td>
<td class="sin"></td>
<td class="sin"></td>
<td class="sin"></td>
</tr>
         
    </table>


</div>


@endsection