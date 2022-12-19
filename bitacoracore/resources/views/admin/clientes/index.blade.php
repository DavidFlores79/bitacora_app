@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Clientes')
@section('ngApp', 'clientes')
@section('ngController', 'clientes')

@section('content')

<div class="container-fluid mt-3 col-11">

  <div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between">
      <h6 class="mt-1">@yield('page-title')</h6>
      <button data-toggle="tooltip" data-placement="top" title="" class="btn btn-success d-flex justify-content-center align-items-center" ng-click="create()"><i class="fas fa-plus mr-1"></i>Nuevo
      </button>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
          <thead class="">
            <tr class="text-left">
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre'; sortReverse = !sortReverse"> Nombre </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.apellido'; sortReverse = !sortReverse"> Apellidos </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.perfil_id'; sortReverse = !sortReverse"> Perfil </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nickname'; sortReverse = !sortReverse"> Nickname </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.servicio.nombre'; sortReverse = !sortReverse"> Servicio </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.estatus'; sortReverse = !sortReverse"> Estado </a></th>
              <th>Opc.</th>
            </tr>
          </thead>
          <tbody>
            <tr dir-paginate="dato in datosFiltrados = (datos|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize" current-page="currentPage" pagination-id="itemsPagination" class="text-left">
              <td style="min-width: 150px;">@{{ dato.nombre }}</td>
              <td style="min-width: 150px;">@{{ dato.apellido }}</td>
              <td style="min-width: 150px;">@{{ dato.mi_perfil.nombre }}</td>
              <td style="min-width: 150px;">@{{ dato.nickname }}</td>
              <td style="min-width: 200px;">@{{ dato.servicios | listarServicios }}</td>
              <td ng-if="dato.bloqueado == 0"><span class="badge badge-pill badge-success">Activo</span></td>
              <td ng-if="dato.bloqueado == 1"><span class="badge badge-pill badge-danger">Inactivo</span></td>
              <td class="d-flex justify-content-center">
                <button class="btn btn-primary mr-2" ng-click="edit(dato)"><span data-toggle="tooltip" data-placement="top" title="Editar" onmouseenter="$(this).tooltip('show')"><i class="fas fa-edit"></i></button>

                <button class="btn btn-danger" ng-click="confirmarEliminar(dato)"><span data-toggle="tooltip" data-placement="top" title="Eliminar" onmouseenter="$(this).tooltip('show')"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="text-right">
          @{{ datos.length }} Registros
        </div>
        <div class="btn-toolbar" role="toolbar" aria-label="">
          <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination" on-page-change="pageChangeHandler(newPageNumber)">
          </dir-pagination-controls>
        </div>
      </div>

    </div>
  </div>

</div>

<!-- Modal Crear  -->
<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregarModalLabel">Crear @yield('page-title')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createForm" ng-submit="store()" class="was-validated">
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control required" id="nombre" ng-model="createForm.nombre" maxlength="255" required>
            </div>
            <div class="col-md-6 py-2">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control required" id="apellido" ng-model="createForm.apellido" maxlength="255" required>
            </div>
          </div>
          <div class="row">
            @if(auth()->user()->perfil_id == 1)
            <div class="col-md-12 py-2">
              <label for="servicios_asig" class="form-label">Servicio(s)</label>
              <select name="servicios_asig" 
                      id="servicios_asig" 
                      class="form-control show-tick selectpicker" 
                      data-style="btn-default" 
                      data-live-search="true" 
                      title="Selecciona..." 
                      multiple 
                      data-actions-box="true" 
                      data-selected-text-format="count > 0" 
                      data-size="6"
                      required>
                <option value="@{{servicio.id}}" ng-repeat="servicio in servicios">@{{servicio.nombre}}</option>
              </select>
            </div>
            @endif
            <div class="col-md-6 py-2">
              <label for="perfil" class="form-label">Perfil del Usuario</label>
              <select id="perfil" class="form-control" ng-model="createForm.perfil" required>
                <option value="" disabled>Selecciona...</option>
                <option ng-repeat="perfil in perfiles" value="@{{ perfil.id }}">
                  @{{ perfil.nombre }}</option>
              </select>
            </div>
            <div class="col-md-6 py-2">
              <label for="nickname" class="form-label">Nickname</label>
              <input id="nickname" type="text" class="form-control" ng-model="createForm.nickname" required>
            </div>
            <div class="col-md-12 py-2">
              <label for="email" class="form-label">Correo</label>
              <input id="email" type="email" class="form-control" ng-model="createForm.email" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="telefono" class="form-label">Telefono</label>
              <input id="telefono" type="text" class="form-control" ng-model="createForm.telefono" minlength="10"
                maxlength="10" pattern="^\d+$">
            </div>
            <div class="col-md-6 py-2">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" ng-model="createForm.password" required
                placeholder="Mínimo 6 caracteres" minlength="6" maxlength="255">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar  -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarModalLabel">Editar @yield('page-title')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form ng-submit="update()" class="was-validated">
          <input type="hidden" name="id" id="edit-id">
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control required" id="nombre_edit" ng-model="dato.nombre" maxlength="255" required>
            </div>
            <div class="col-md-6 py-2">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control required" id="apellido_edit" ng-model="dato.apellido" maxlength="255" required>
            </div>
          </div>
          <div class="row">
            @if(auth()->user()->perfil_id == 1)
            <div class="col-md-12 py-2">
              <label for="servicios_asig_edit" class="form-label">Servicio(s)</label>
              <select name="servicios_asig_edit" 
                      id="servicios_asig_edit" 
                      class="form-control show-tick selectpicker" 
                      data-style="btn-default" 
                      data-live-search="true" 
                      title="Selecciona..." 
                      multiple 
                      data-actions-box="true" 
                      data-selected-text-format="count > 0" 
                      data-size="6"
                      required>
                <option value="@{{servicio.id}}" ng-repeat="servicio in servicios">@{{servicio.nombre}}</option>
              </select>
            </div>
            @endif
            <div class="col-md-6 py-2">
              <label for="perfil_edit" class="form-label">Perfil del Usuario</label>
              <select id="perfil_edit" class="form-control" ng-model="dato.perfil_id" required>
                <option value="" disabled>Selecciona...</option>
                <option ng-repeat="perfil in perfiles" ng-selected="dato.id" value="@{{ perfil.id }}">
                  @{{ perfil.nombre }}</option>
              </select>
            </div>
            <div class="col-md-6 py-2">
              <label for="nickname_edit" class="form-label">Nickname</label>
              <input id="nickname_edit" type="text" class="form-control" ng-model="dato.nickname" required>
            </div>
            <div class="col-md-12 py-2">
              <label for="email_edit" class="form-label">Correo</label>
              <input id="email_edit" type="email" class="form-control" ng-model="dato.email" required>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar @yield('page-title')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Realmente desea eliminar al elemento <span class="font-weight-bold" id="nombre-dato"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" ng-click="delete(dato)">Eliminar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')
<script src="{{ asset('assets') }}/js/clientes.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>
@endpush