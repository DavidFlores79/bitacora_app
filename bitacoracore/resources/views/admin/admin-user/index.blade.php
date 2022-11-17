@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Administración de usuarios')
@section('ngApp', 'admin_user')
@section('ngController', 'admin_user')

@section('content')

<div class="container-fluid mt-3 col-11">

  <div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between">
      <h6 class="mt-1">Usuarios</h6>
      <button data-toggle="tooltip" data-placement="top" title="Agregar ticket"
        class="btn btn-success d-flex justify-content-center align-items-center" ng-click="modalNuevo()"><i
          class="fas fa-user mr-1"></i>Nuevo Usuario
      </button>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
          <thead class="">
            <tr class="">
              <th><a class="text-body" href="#" ng-click="sortType = 'usuario.name'; sortReverse = !sortReverse"> Nombre </a>
              </th>
              <th><a class="text-body" href="#" ng-click="sortType = 'usuario.mi_perfil.nombre'; sortReverse = !sortReverse"> Perfil </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'usuario.email'; sortReverse = !sortReverse"> Email </a>
              </th>
              <th><a class="text-body" href="#" ng-click="sortType = 'usuario.telefono'; sortReverse = !sortReverse"> Telefono </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'usuario.estatus'; sortReverse = !sortReverse"> Estado </a></th>
              <th>Opc.</th>

            </tr>
          </thead>
          <tbody>
            <tr
              dir-paginate="usuario in datosFiltrados = (usuarios|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
              current-page="currentPage" pagination-id="itemsPagination">
              <td>@{{ usuario.name }} @{{ usuario.apellido }}</td>
              <td>@{{ usuario.mi_perfil.nombre }}</td>
              <td>@{{ usuario.email }}</td>
              <td>@{{ usuario.telefono }}</td>
              <td ng-if="usuario.bloqueado == 0"><span class="badge badge-pill badge-success">Activo</span></td>
              <td ng-if="usuario.bloqueado == 1"><span class="badge badge-pill badge-danger">Inactivo</span></td>
              <td>
                <button class="btn btn-primary" ng-click="modalEditar(usuario.id)"><span data-toggle="tooltip" data-placement="top" title="Editar usuario" onmouseenter="$(this).tooltip('show')"><i class="fas fa-edit"></i></button>
                
                <button class="btn btn-danger" ng-click="eliminar(usuario.id)"><span data-toggle="tooltip"
                data-placement="top" title="Eliminar usuario" onmouseenter="$(this).tooltip('show')"><i class="fas fa-trash-alt"></i></button>
                
                <button class="btn btn-info" ng-click="modalRestPssword(usuario)"><span data-toggle="tooltip" data-placement="top" title="Rest. Contraseña" onmouseenter="$(this).tooltip('show')"><i class="fas fa-key"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="text-right">
          @{{ usuarios.length }} Registros
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
<script src="{{ asset('assets') }}/js/admin-user.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>
@endpush
