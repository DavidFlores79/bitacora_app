@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Reporte de Visitas')
@section('ngApp', 'visitas')
@section('ngController', 'visitas')

@section('content')

<div class="container-fluid mt-3 col-11">

  <div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between">
      <h6 class="mt-1">@yield('page-title')</h6>
      <button data-toggle="tooltip" data-placement="top" title="Agregar ticket"
        class="btn btn-success d-flex justify-content-center align-items-center" ng-click="create()"><i
          class="fas fa-user mr-1"></i>Nueva visita
      </button>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
          <thead class="">
            <tr class="">
              </th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre_datonte'; sortReverse = !sortReverse"> Visitante </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre_quien_dato'; sortReverse = !sortReverse"> A Quien Visita </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.motivo_dato'; sortReverse = !sortReverse"> Motivo </a>
            </th>
            <th><a class="text-body" href="#" ng-click="sortType = 'dato.placas'; sortReverse = !sortReverse"> Placas </a></th>
            <th><a class="text-body" href="#" ng-click="sortType = 'dato.user_id'; sortReverse = !sortReverse"> Recibió </a>
            <th><a class="text-body" href="#" ng-click="sortType = 'dato.app_id'; sortReverse = !sortReverse"> AppId </a>
              <th>Opc.</th>

            </tr>
          </thead>
          <tbody>
            <tr
              dir-paginate="dato in datosFiltrados = (datos|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
              current-page="currentPage" pagination-id="itemsPagination">
              <td style="min-width: 150px;">@{{ dato.nombre_visitante }}</td>
              <td style="min-width: 150px;">@{{ dato.nombre_quien_visita }}</td>
              <td>@{{ dato.motivo_visita }}</td>
              <td>@{{ dato.placas }}</td>
              <td>@{{ dato.user.nombre }}</td>
              <td>@{{ dato.app_id }}</td>
              <td class="d-flex justify-content-between">
                <button class="btn btn-primary mr-2" ng-click="modalEditar(dato.id)"><span data-toggle="tooltip" data-placement="top" title="Editar visita" onmouseenter="$(this).tooltip('show')"><i class="fas fa-edit"></i></button>
                
                <button class="btn btn-danger" ng-click="eliminar(dato.id)"><span data-toggle="tooltip"
                data-placement="top" title="Eliminar dato" onmouseenter="$(this).tooltip('show')"><i class="fas fa-trash-alt"></i></button>
                
              </td>
            </tr>
          </tbody>
        </table>
        <div class="text-right">
          @{{ datos.length }} Registros
        </div>
        <div class="btn-toolbar" role="toolbar" aria-label="Calimax">
          <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination"
            on-page-change="pageChangeHandler(newPageNumber)">
          </dir-pagination-controls>
        </div>
      </div>

    </div>
  </div>

</div>

@include('includes.modals.adminuser_modals')

@endsection

@push('js')
<script src="{{ asset('assets') }}/js/visitas.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>
@endpush
