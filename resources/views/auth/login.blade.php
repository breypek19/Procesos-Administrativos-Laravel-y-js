@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header align-center">{{ __('Inicio de Sesion') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class=" col-sm-3 col-md-3  text-md-right icon1"> 
                                <i class="material-icons text-info">account_circle</i>
                            </div>

                            <div class=" col-sm-9 col-md-6">
                           
                                <input  id="nom_usuario" placeholder="Ingrese con su Usuario" type="text" class="form-control @error('nom_usuario') is-invalid @enderror" name="nom_usuario" value="{{ old('nom_usuario') }}" required  autofocus />

                                @error('nom_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div  class="col-sm-3 col-md-3 icon1  text-md-right">
                            <i class="material-icons text-info">lock</i>
                            </div>

                            <div class="col-sm-9 col-md-6">
                                <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
