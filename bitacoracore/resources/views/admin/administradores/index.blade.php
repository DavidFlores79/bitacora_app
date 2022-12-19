@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Administradores')
@section('ngApp', 'administradores')
@section('ngController', 'administradores')

@section('content')

<div class="container-fluid mt-3 col-11">

  <div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between">
      <h6 class="mt-1">@yield('page-title')</h6>
      <button data-toggle="tooltip" data-placement="top" title=""
        class="btn btn-success d-flex justify-content-center align-items-center" ng-click="create()"><i
          class="fas fa-plus mr-1"></i>Nuevo
      </button>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
          <thead class="">
            <tr class="">
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre'; sortReverse = !sortReverse"> Nombre </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.apellido'; sortReverse = !sortReverse"> Apellidos </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.perfil_id'; sortReverse = !sortReverse"> Perfil </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nickname'; sortReverse = !sortReverse"> Nickname </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.servicio.nombre'; sortReverse = !sortReverse"> Servicio </a></th>
              <th>Opc.</th>
            </tr>
          </thead>
          <tbody>
            <tr
              dir-paginate="dato in datosFiltrados = (datos|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
              current-page="currentPage" pagination-id="itemsPagination">
              <td style="min-width: 150px;">@{{ dato.nombre }}</td>
              <td style="min-width: 150px;">@{{ dato.apellido }}</td>
              <td style="min-width: 150px;">@{{ dato.mi_perfil.nombre }}</td>
              <td style="min-width: 150px;">@{{ dato.nickname }}</td>
              <td style="min-width: 150px;">@{{ dato.servicios | listarServicios }}</td>
              <td class="d-flex justify-content-center">
                <button class="btn btn-primary mr-2" ng-click="edit(dato)"><span data-toggle="tooltip" data-placement="top" title="Editar" onmouseenter="$(this).tooltip('show')"><i class="fas fa-edit"></i></button>
                
                <button class="btn btn-danger" ng-click="confirmarEliminar(dato)"><span data-toggle="tooltip"
                data-placement="top" title="Eliminar" onmouseenter="$(this).tooltip('show')"><i class="fas fa-trash-alt"></i></button>                
              </td>
            </tr>
          </tbody>
        </table>
        <div class="text-right">
          @{{ datos.length }} Registros
        </div>
        <div class="btn-toolbar" role="toolbar" aria-label="">
          <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination"
            on-page-change="pageChangeHandler(newPageNumber)">
          </dir-pagination-controls>
        </div>
      </div>

    </div>
  </div>

</div>

@include('includes.modals.user_modals')

@endsection

@push('js')
<script src="{{ asset('assets') }}/js/administradores.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>
@endpush
