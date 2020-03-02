@extends('layouts.layoutSecre')

@section('datatable')
<script type="text/javascript" src="{{asset('js/datatables.min.js')}}" defer></script>
<script type="text/javascript" src="{{ asset('js/secre/reporteDatatableSecretaria.js') }}" defer></script>
@endsection


@section('datataCss')   
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/cantidades.css') }}" rel="stylesheet">
@endsection


@section('content')
<div class="container">

    <br>
    <br>
<div class="d-flex justify-content-center flex-wrap recuento mt-5 ">

<div class= "mt-4 mt-sm-4 mt-md-2 mt-lg-0"  id="total">Total Miembros Ipuc: <strong></strong> </div>
<div class="mt-4 mt-sm-4 mt-md-2 mt-lg-0" id="H">Hombres : <strong></strong> </div>
<div class="mt-4 mt-sm-4 mt-md-2 mt-lg-0" id="M">Mujeres: <strong></strong> </div>
<div class="mt-4 mt-sm-4 mt-md-2 mt-lg-0    "  id="jovenes">Miembros Jóvenes: <strong></strong> </div>
<div class="mt-4 mt-sm-4 mt-md-2 mt-lg-0" id="bautizadosSinE">Miembros sin el E.S: <strong></strong> </div>
<div class="mt-4 mt-sm-4 mt-md-2 mt-lg-0" id="visitas">Visitas: <strong></strong></div>
</div>


<div class="table-responsive mt-5">
   <table id="ReportSecre" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha Bautismo</th>
                <th>Pastor Bautismo</th>
                <th>Fecha Espiritu</th>
                <th>Estado</th>
                
                
                
            </tr>
        </thead>
        
    </table>

</div>


</div>
@endsection