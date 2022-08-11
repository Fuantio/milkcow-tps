@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                <form method="POST" action="{{url('/')}}/produccion">

@csrf

<div class="form-group row">
    <label for="vaca" class="col-md-4 col-form-label text-md-right">{{ __('VACA')}}</label>
        <div class="col-md-6"> 
    <select name="vaca" id="vaca" class="form-control @error('vaca') is-invalid @enderror">
        
        @foreach ($vacas as $vaca)
    
        <option value="{{ $vaca['Id_animal']}}">{{ $vaca['nombre']}}</option>
        
        @endforeach
    
    </select>
        @error('vaca')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label for="cantidad" class="col-md-4 col-form-label text-md-right">{{ __('CANTIDAD(Litros)')}}</label>
        <div class="col-md-6"> 
        <input id="cantidad" type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="" require autocomplete="cantidad" autofocus>

        @error('cantidad')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="responsable" class="col-md-4 col-form-label text-md-right">{{ __('RESPONSABLE')}}</label>
        <div class="col-md-6"> 
        <select name="responsable" id="responsable" class="form-control @error('responsable') is-invalid @enderror">

        @foreach($usuarios as $usuario)

        <option value="{{ $usuario['id']}}">{{ $usuario['name']}}</option>
       
        @endforeach
    
    </select>
        @error('responsable')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="jornada" class="col-md-4 col-form-label text-md-right">{{ __('JORNADA')}}</label>
        <div class="col-md-6"> 
        <select name="jornada" id="jornada" class="form-control @error('jornada') is-invalid @enderror">
        <option value="mañana">mañana</option>
        <option value="tarde">tarde</option>
        </select>
        @error('jornada')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('FECHA')}}</label>
        <div class="col-md-6"> 
        <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="" require autocomplete="fecha" autofocus>

        @error('fecha')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Agregar')}}
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
