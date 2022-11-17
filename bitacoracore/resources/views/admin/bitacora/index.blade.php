@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Bitácora')
@section('ngApp', 'bitacora')
@section('ngController', 'bitacora')

@section('content')

<div class="container-fluid mt-3 col-11">
    <div class="card shadow">
        <div class="card-header bg-default d-md-flex justify-content-between ">
            <a class="btn update-bitacora" data-toggle="tooltip" data-placement="right" title="Job Actualizar">
                <span ng-if="detenido != true" ng-click="stop()"><i class="fas fa-stop-circle"></i></span>
                <span ng-if="detenido != false" ng-click="start()"><i class="fas fa-play-circle"></i></span>
            </a>
            <h5 class="font-weight-bold centers-title">@yield('page-title')</h5>
            <input type="text" name="buscar" class="search-query form-control col-lg-3 col-md-4 col-sm-12"
                placeholder="Buscar..." ng-model="searchQuery">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center">
                    <thead class="">
                        <tr class="">
                            <th class=""><a class="text-body" href="#"
                                    ng-click="sortType = 'id'; sortReverse = !sortReverse"> ID </a></th>
                            <th><a class="text-body" href=""
                                    ng-click="sortType = 'descripcion'; sortReverse = !sortReverse"> Descripcion </a>
                            </th>
                            <th><a class="text-body" href=""
                                    ng-click="sortType = 'nickname_nombre'; sortReverse = !sortReverse"> Usuario</a>
                            </th>
                            <th><a class="text-body" href=""
                                    ng-click="sortType = 'created_at'; sortReverse = !sortReverse"> Fecha</a></th>
                            <th><a class="text-body" href=""
                                    ng-click="sortType = 'direccion_ip'; sortReverse = !sortReverse"> IP</a></th>
                            <th><a class="text-body" href=""> Opc.</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-model="bitacoras"
                            dir-paginate="bitacora in datosFiltrados = (bitacoras|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
                            current-page="currentPage" pagination-id="itemsPagination">
                            <td>@{{bitacora.id}}</td>
                            <td>@{{bitacora.descripcion}}</td>
                            <td>@{{bitacora.nickname_nombre}}</td>
                            <td>@{{bitacora.created_at | date:"yyyy-MM-dd '-' h:mma"}}</td>
                            <td>@{{bitacora.direccion_ip}}</td>
                            <td><a ng-class="{0:'btn-danger', 1:'btn-info'}[bitacora.exitoso]" class="btn "
                                    ng-click="bitacoraDetalle(bitacora)"><i class="fas fa-info-circle"></i></a></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    @{{bitacoras.length}} Registros
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

<!-- Detalle de Bitacora Modal -->
<div class="modal fade" id="bitacora-modal" tabindex="-1" aria-labelledby="bitacora-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="bitacora-modalLabel">Bitácora</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="bitacora_trace"></p>
                <p id="bitacora_documento"></p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('ngFile')
<script src="{{ asset('assets/js/bitacora.js') }}"></script>
<script>

</script>
@endsection