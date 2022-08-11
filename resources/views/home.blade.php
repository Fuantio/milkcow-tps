@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <!-- <div class="form-group">
                    <label for="">Color:</label>

                    <input type="text" name="" id="" v-model="color"> <input type="text" name="" style="width: 30px" v-bind:style="{'background-color':color}" readonly>

                </div>
                <div class="form-group">
                    <label for="">Color:</label>
                    <select name="" id="" v-model="color">
                        <option value="blue">Asul</option>
                        <option value="red">Rojo</option>
                        <option value="yellow">Amariyo</option>
                        <option value="orange">Naranja</option>
                        <option value="grey">Gris</option>
                        <option value="cyan">Cian</option>
                        <option value="Black">Negro</option>
                        <option value="purple">Morao</option>
                        <option value="brown">Caje</option>
                        <option value="green">erde</option>
                        <option value="pink">Rosao</option>
                        <option value="violet">fuckxiaxd</option>
                        <option value="silver">platiado xd</option>
                    </select>

                </div>
                <div class="card-body">
                    <p>Operaciones matematicas xd</p>
                    <label for="">Digite el primer numero</label>
                    <br>
                    <input type="text" v-model="numero1" v-on:keyup="calcular">
                    <br>
                    <label for="">Digite el segundo numero </label>
                    <br>
                    <input type="text" v-model="numero2" v-on:keyup="calcular">
                    <br>
                    <br>
                    <label for="">operaciones</label>
                    <select name="" id="" v-model="operacion" v-on:change="calcular">
                        <option value="suma">Sumar</option>
                        <option value="resta">Restar</option>
                        <option value="multi">Multiplicar</option>
                        <option value="div">Divicion</option>
                    </select>
                    <p>El resultado de la respectiva operacion seleccionado a partir de sus criterios establecidos es un total de:@{{ resultado }}</p> -->


                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
