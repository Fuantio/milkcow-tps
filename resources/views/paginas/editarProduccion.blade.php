@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDITAR PRODUCCION') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
              
                    @foreach($producciones as $produccion)

                    <form method="POST" action="{{url('/')}}/produccion/{{$produccion['ID_Produccion']}}">

                        @method('PUT')

                        @csrf

                        <div class="form-group row">
                            <label for="ID_Produccion" class="col-md-4 col-form-label text-md-right">{{ __('ID')}}</label>
                                <div class="col-md-6"> 
                                <input id="ID_Produccion" type="text" class="form-control @error('ID_Produccion') is-invalid @enderror" name="ID_Produccion" value="{{ $produccion['ID_Produccion']}}" require autocomplete="ID_Produccion" autofocus readonly>

                                @error('ID_Produccion')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vaca" class="col-md-4 col-form-label text-md-right">{{ __('VACA')}}</label>
                                <div class="col-md-6"> 
                            <select name="vaca" id="vaca" class="form-control @error('vaca') is-invalid @enderror">
                                
                                @foreach($vacas as $vaca)
                            
                                <option value="{{ $vaca['Id_animal']}}"@if($vaca['Id_animal']==$produccion['vaca']){{ 'selected' }}@endif>{{ $vaca['nombre']}}</option>
                                
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
                            <label for="cantidad" class="col-md-4 col-form-label text-md-right">{{ __('CANTIDAD')}}</label>
                                <div class="col-md-6"> 
                                <input id="cantidad" type="text" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="{{ $produccion['cantidad']}}" require autocomplete="cantidad" autofocus>

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

                                <option value="{{ $usuario['id']}}"@if($usuario['id']==$produccion['responsable']){{ 'selected' }}@endif>{{ $usuario['name']}}</option>
                               
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
                                <option value="mañana" @if ($produccion['jornada'] == 'mañana'){{ 'selected' }}@endif>mañana</option>
                                <option value="tarde" @if ($produccion['jornada'] == 'tarde'){{ 'selected' }}@endif>tarde</option>
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
                                <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ $produccion['fecha']}}" require autocomplete="fecha" autofocus>

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
                                    {{ __('Actualizar')}}
                                </button>

                            </div>
                        </div>
                    </form>

                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection