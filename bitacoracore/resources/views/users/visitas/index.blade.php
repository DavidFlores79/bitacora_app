@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Visitantes')
@section('ngApp', 'visitas')
@section('ngController', 'visitas')

@section('content')

<div class="container-fluid mt-3 col-11">

  <div class="card shadow">
  <div class="card-header bg-white d-flex justify-content-between">
      <!-- <h6 class="mt-1">@yield('page-title')</h6>
      <button data-toggle="tooltip" data-placement="top" title="Agregar ticket"
        class="btn btn-success d-flex justify-content-center align-items-center" ng-click="create()"><i
          class="fas fa-plus mr-1"></i>Agregar Visitante
      </button> -->
      <div class="col-md-8 col-sm-4">
        <h6 class="mt-1">@yield('page-title')</h6>
      </div>
      <div class="col-md-4 col-sm-8">
        <select ng-model="servicios" ng-disabled="servicios.length <= 0" name="servicio_selected" id="servicio_selected" class="form-control" required autofocus>
          <option value="">Filtra por servicio...</option>
          <option value="@{{ servicio.id }}" ng-repeat="servicio in servicios"> @{{ servicio.nombre }}</option>
        </select>
      </div>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
          <thead class="">
            <tr class="">
              </th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.imagen_identificacion'; sortReverse = !sortReverse"> INE </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre_datonte'; sortReverse = !sortReverse"> Visitante </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre_quien_dato'; sortReverse = !sortReverse"> A Quien Visita </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.motivo_dato'; sortReverse = !sortReverse"> Motivo </a>
              </th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.tipo_vehiculo_id'; sortReverse = !sortReverse"> Tipo </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.placas'; sortReverse = !sortReverse"> Placas </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.user_id'; sortReverse = !sortReverse"> Recibió </a>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.fecha_entrada'; sortReverse = !sortReverse"> Entrada </a>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.fecha_salida'; sortReverse = !sortReverse"> Salida </a>
                <!-- <th><a class="text-body" href="#" ng-click="sortType = 'dato.app_id'; sortReverse = !sortReverse"> AppId </a> -->
              <th>Opc.</th>

            </tr>
          </thead>
          <tbody>
            <!-- <tr class="fila-visita" ng-click="show(dato)" -->
            <tr dir-paginate="dato in datosFiltrados = (datos|filter:servicios.servicio_id|orderBy:sortType:sortReverse)|itemsPerPage:pageSize" current-page="currentPage" pagination-id="itemsPagination">
              <td><img class="imagen_id" ng-click="show(dato)" data-ng-src="data:image/png;base64,@{{dato.imagen_identificacion}}" /></td>
              <td style="min-width: 150px;">@{{ dato.nombre_visitante }}</td>
              <td style="min-width: 150px;">@{{ dato.nombre_quien_visita }}</td>
              <td>@{{ dato.motivo_visita }}</td>
              <td><i ng-class="{2:'fas fa-motorcycle fa-2x moto', 1:'fas fa-car-side fa-2x carro', 3:'fas fa-truck-moving fa-2x camion'}[dato.tipo_vehiculo_id]"></i></td>
              <td>@{{ dato.placas | uppercase }}</td>
              <td>@{{ dato.user.nombre }} @{{ dato.user.apellido }}</td>
              <td>@{{ fixDate(dato.fecha_entrada) | date:"yyyy-MM-dd '-' h:mma" }}</td>
              <td>@{{ fixDate(dato.fecha_salida) | date:"yyyy-MM-dd '-' h:mma" }}</td>
              <!-- <td>@{{ dato.app_id }}</td> -->
              <td class="d-flex justify-content-between">
                <button class="btn btn-info mr-2" ng-click="show(dato)"><span data-toggle="tooltip" data-placement="top" title="Detalles de la visita" onmouseenter="$(this).tooltip('show')"><i class="far fa-eye"></i></button>

                <button class="btn btn-primary mr-2" ng-click="edit(dato)"><span data-toggle="tooltip" data-placement="top" title="Editar visita" onmouseenter="$(this).tooltip('show')"><i class="fas fa-edit"></i></button>


                <button class="btn btn-danger" ng-click="confirmarEliminar(dato)"><span data-toggle="tooltip" data-placement="top" title="Eliminar dato" onmouseenter="$(this).tooltip('show')"><i class="fas fa-trash-alt"></i></button>

              </td>
            </tr>
          </tbody>
        </table>
        <div class="text-right">
          @{{ datos.length }} Registros
        </div>
        <div class="btn-toolbar" role="toolbar" aria-label="Calimax">
          <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination" on-page-change="pageChangeHandler(newPageNumber)">
          </dir-pagination-controls>
        </div>
      </div>

    </div>
  </div>

</div>

@include('includes.modals.visit_modals')

@endsection

@push('js')
<script src="{{ asset('assets') }}/js/visitas.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>
@endpush