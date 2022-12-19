@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Perfiles')
@section('ngApp', 'perfiles')
@section('ngController', 'perfiles')

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
              <th>Opc.</th>
            </tr>
          </thead>
          <tbody>
            <tr
              dir-paginate="dato in datosFiltrados = (datos|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
              current-page="currentPage" pagination-id="itemsPagination">
              <td style="min-width: 150px;" class="pl-4 text-left">@{{ dato.nombre }}</td>
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
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" ng-model="createForm.nombre" required autofocus>
                    </div>
                    <div class="form-group">
                    <label for="nombre">Código:</label>
                      <select class="form-control" 
                          ng-options="codigo.nombre as codigo.descripcion for codigo in codigos" 
                          ng-model="createForm.codigo"
                          required>
                          <option value="" selected>Seleciona una opción... </option>
                      </select>
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
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="edit-nombre" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
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
<script src="{{ asset('assets') }}/js/perfiles.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>
@endpush
