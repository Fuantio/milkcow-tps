
@extends('layouts.app')

@section('content')
<div class="card-header">
    <div class="container col col-md-12">
        <div class="form-group col-md-4">
            <h3>Buscar Año/Mes:</h3>
            <input v-model="graficarProduccion" type="month" min="2022-01" class="form-control" v-on:change="buscarMonthYear()">

        </div>
    </div>
</div>

<div id="barchart_month" style="width: 900px; height: 300px;"></div>

@endsection
