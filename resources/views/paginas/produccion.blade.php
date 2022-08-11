
@extends('layouts.app')

@section('content')
<div class="card-header">
  <div class="container col col-md-11">
    <div class="form-group col-md-4">
      <h3>Buscar Fecha:</h3>
      <input v-model="textoProduccion" type="date" class="form-control" v-on:change="buscarProduccion()">
      <br>
      <h3>Buscar Vaca:</h3>
      <input v-model="textoVaca" type="text" class="form-control" v-on:keyup="buscarVaca()">
</div>

    <div class="row col col-md-12">
      
      <div id="barchart_values" style="margin: auto" class="card col-md-4"></div>
      
      <div class="col-md-7">
        
        <div class="card">
          


          <div class="card-header">{{ __('PRODUCCION') }}</div>

          <div class="card-body">
            

            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif

            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Id</th>
                  <th>Vaca</th>
                  <th>Cantidad</th>
                  <th>Responsable</th>
                  <th>Jornada</th>
                  <th>Fecha</th>
                  @auth
                  <th>Acciones</th>
                  @endauth
                </tr>
              </thead>
              <tbody>


                <tr v-for="(produccion, index) in producciones" v-show="index >= desdeProduccion && index < hastaProduccion">
                  <td>@{{produccion.ID_Produccion}}</td>
                  <td>@{{produccion.nombre}}</td>
                  <td>@{{produccion.cantidad}}</td>
                  <td>@{{produccion.name}}</td>
                  <td>@{{produccion.jornada}}</td>
                  <td>@{{produccion.fecha}}</td>
                  @auth
                  <td>
                 
                    <a v-bind:href="'http://127.0.0.1:8000/produccion/'+produccion.ID_Produccion">
                      Editar
                    </a>
                  
                    @if ( Auth::user()->type_user == 'Instructor')
                    <a href="#" v-on:click="eliminarProduccion(produccion.ID_Produccion)">
                      Eliminar
                    </a>
                    @endif
                  
                  </td>
                  @endauth
                </tr>
                
              </tbody>
            </table>
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li v-bind:class="ocultarMostrarAnteriorProduccion">
                  <a v-on:click="anterior" class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li v-for="(pagina, index) in paginasProduccion" v-bind:class="botonesProduccion[index]">
                  <a class="page-link" href="#" v-on:click="paginar(pagina)">@{{pagina}}</a>
                </li>
                <li v-if="paginasProduccion == 1" class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                <li v-else v-bind:class="ocultarMostrarSiguienteProduccion">
                  <a v-on:click="siguiente" class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="barchart_values" style="width: 900px; height: 300px;"></div>

  @endsection
