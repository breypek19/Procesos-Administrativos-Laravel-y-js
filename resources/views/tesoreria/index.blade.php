@extends('layouts.layoutTeso')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hola, {{ Auth::user()->nom_usuario }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   Bienvenido Al Sistema
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
