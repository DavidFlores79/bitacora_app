@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Requerimientos')
@section('ngApp', 'requerimientos')
@section('ngController', 'requerimientos')

@section('content')

    <div class="container-fluid mt-1 col-11">
        <div class="card shadow">

            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item ">
                        <a class="nav-link active" href="#seccion1" role="tab" data-toggle="tab">Asignados</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#seccion2" role="tab" data-toggle="tab">Tickets</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#seccion3" role="tab" data-toggle="tab">Tickets próximos a vencer</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#seccion4" role="tab" data-toggle="tab">Tickets Vencidos</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#seccion5" role="tab" data-toggle="tab">Tickets Cerrados</a>
                    </li>
                </ul>

            </div>
            <div class="card-body tab-content">
                <div role="tabpanel" class="tab-pane active" id="seccion1">
                    <div class="m-2">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center" id="tbl_tickets">
                                <thead class="">
                                    <tr class="">
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> No Ticket </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Tipo </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Proyecto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asunto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asignado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Estado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Prioridad </a></th>
                                        {{-- <th><a class="text-body" href="#"
                                            ng-click="sortType = 'id'; sortReverse = !sortReverse"> Progreso </a></th> --}}
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Fecha </a></th>
                                        <th>Opc.</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="tickets.length == 0">
                                        <td class="text-center" colspan="9">Sin datos guardados</td>
                                    </tr>

                                    <tr ng-model="tickets"
                                        dir-paginate="ticket in datosFiltrados = (tickets|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
                                        current-page="currentPage" pagination-id="itemsPagination">
                                        <td><a class="text-body font-weight-bold" href=""
                                                ng-click="moduloProv('{{ Crypt::encrypt(session('modulo_id')) }}',ticket.id)">@{{ ticket.id }}</a>
                                        </td>
                                        <td>@{{ ticket.tipo.descripcion }}</td>
                                        <td>@{{ ticket.proyecto.nombre }}</td>
                                        <td>@{{ ticket.titulo }}</td>
                                        <td>@{{ ticket.especialista.name }}</td>
                                        <td ng-if="ticket.estatus.id == estados.registrado"><span
                                                class="btn btn-secondary text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.en_proceso"><span
                                                class="btn btn-info text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.en_espera"><span
                                                class="btn btn-primary text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.asignado"><span
                                                class="btn btn-warning text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.resuelto"><span
                                                class="btn btn-success text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td>@{{ ticket.prioridad.descripcion }}</td>
                                        {{-- <td>@{{ ticket.progreso }}</td> --}}
                                        <td>@{{ ticket.created_at | date }}</td>
                                        <td>
                                            <button class="btn btn-primary mr-1" ng-click="modalEditar(ticket.id)"><span
                                                    data-toggle="tooltip" data-placement="top" title="Ver Ticket"><i
                                                        class="far fa-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                @{{ tickets.length }} Registros
                            </div>
                            <div class="btn-toolbar" role="toolbar" aria-label="Calimax">
                                <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination"
                                    on-page-change="pageChangeHandler(newPageNumber)">
                                </dir-pagination-controls>
                            </div>
                        </div>

                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="seccion2">

                    <div class="m-2">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center" id="tbl_tickets">
                                <thead class="">
                                    <tr class="">
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> No Ticket </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Tipo </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Proyecto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asunto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asignado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Estado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Prioridad </a></th>
                                        {{-- <th><a class="text-body" href="#"
                                            ng-click="sortType = 'id'; sortReverse = !sortReverse"> Progreso </a></th> --}}
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Fecha </a></th>
                                        <th>Opc.</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="ticketsAll.length == 0">
                                        <td class="text-center" colspan="9">Sin datos guardados</td>
                                    </tr>

                                    <tr ng-model="ticketsAll"
                                        dir-paginate="ticket in datosFiltrados = (ticketsAll|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
                                        current-page="currentPage" pagination-id="itemsPagination">
                                        <td><a class="text-body font-weight-bold" href=""
                                                ng-click="moduloProv('{{ Crypt::encrypt(session('modulo_id')) }}',ticket.id)">@{{ ticket.id }}</a>
                                        </td>
                                        <td>@{{ ticket.tipo.descripcion }}</td>
                                        <td>@{{ ticket.proyecto.nombre }}</td>
                                        <td>@{{ ticket.titulo }}</td>
                                        <td>@{{ ticket.especialista.name }}</td>
                                        <td ng-if="ticket.estatus.id == estados.registrado"><span
                                                class="btn btn-secondary text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.en_proceso"><span
                                                class="btn btn-info text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.en_espera"><span
                                                class="btn btn-primary text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.asignado"><span
                                                class="btn btn-warning text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td ng-if="ticket.estatus.id == estados.resuelto"><span
                                                class="btn btn-success text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td>@{{ ticket.prioridad.descripcion }}</td>
                                        {{-- <td>@{{ ticket.progreso }}</td> --}}
                                        <td>@{{ ticket.created_at | date }}</td>
                                        <td>
                                            <button class="btn btn-primary mr-1" ng-click="modalEditar(ticket.id)"><span
                                                    data-toggle="tooltip" data-placement="top" title="Ver Ticket"><i
                                                        class="far fa-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                @{{ ticketsAll.length }} Registros
                            </div>
                            <div class="btn-toolbar" role="toolbar" aria-label="Calimax">
                                <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination"
                                    on-page-change="pageChangeHandler(newPageNumber)">
                                </dir-pagination-controls>
                            </div>
                        </div>

                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="seccion3">

                    <div class="m-2">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center" id="tbl_tickets">
                                <thead class="">
                                    <tr class="">
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> No Ticket </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Tipo </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Proyecto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asunto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asignado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Estado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Prioridad </a></th>
                                        {{-- <th><a class="text-body" href="#"
                                            ng-click="sortType = 'id'; sortReverse = !sortReverse"> Progreso </a></th> --}}
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Fecha </a></th>
                                        <th>Opc.</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="ticketsVencidos.length == 0">
                                        <td class="text-center" colspan="9">Sin datos guardados</td>
                                    </tr>

                                    <tr ng-model="ticketsVencidos"
                                        dir-paginate="ticket in datosFiltrados = (ticketsVencidos|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
                                        current-page="currentPage" pagination-id="itemsPagination">
                                        <td><a class="text-body font-weight-bold" href=""
                                                ng-click="moduloProv('{{ Crypt::encrypt(session('modulo_id')) }}',ticket.id)">@{{ ticket.id }}</a>
                                        </td>
                                        <td>@{{ ticket.tipo.descripcion }}</td>
                                        <td>@{{ ticket.proyecto.nombre }}</td>
                                        <td>@{{ ticket.titulo }}</td>
                                        <td>@{{ ticket.especialista.name }}</td>
                                        <td>@{{ ticket.estatus.descripcion }}</td>
                                        <td>@{{ ticket.prioridad.descripcion }}</td>
                                        {{-- <td>@{{ ticket.progreso }}</td> --}}
                                        <td>@{{ ticket.created_at | date }}</td>
                                        <td>
                                            <button class="btn btn-primary mr-1" ng-click="modalEditar(ticket.id)"><span
                                                    data-toggle="tooltip" data-placement="top" title="Ver Ticket"><i
                                                        class="far fa-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                @{{ ticketsVencidos.length }} Registros
                            </div>
                            <div class="btn-toolbar" role="toolbar" aria-label="Calimax">
                                <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination"
                                    on-page-change="pageChangeHandler(newPageNumber)">
                                </dir-pagination-controls>
                            </div>
                        </div>

                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="seccion4">

                    <div class="m-2">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center" id="tbl_tickets">
                                <thead class="">
                                    <tr class="">
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> No Ticket </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Tipo </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Proyecto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asunto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asignado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Estado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Prioridad </a></th>
                                        {{-- <th><a class="text-body" href="#"
                                            ng-click="sortType = 'id'; sortReverse = !sortReverse"> Progreso </a></th> --}}
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Fecha </a></th>
                                        <th>Opc.</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="ticketsVencidos.length == 0">
                                        <td class="text-center" colspan="9">Sin datos guardados</td>
                                    </tr>

                                    <tr ng-model="ticketsVencidos"
                                        dir-paginate="ticket in datosFiltrados = (ticketsVencidos|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
                                        current-page="currentPage" pagination-id="itemsPagination">
                                        <td><a class="text-body font-weight-bold" href=""
                                                ng-click="moduloProv('{{ Crypt::encrypt(session('modulo_id')) }}',ticket.id)">@{{ ticket.id }}</a>
                                        </td>
                                        <td>@{{ ticket.tipo.descripcion }}</td>
                                        <td>@{{ ticket.proyecto.nombre }}</td>
                                        <td>@{{ ticket.titulo }}</td>
                                        <td>@{{ ticket.especialista.name }}</td>
                                        <td>@{{ ticket.estatus.descripcion }}</td>
                                        <td>@{{ ticket.prioridad.descripcion }}</td>
                                        {{-- <td>@{{ ticket.progreso }}</td> --}}
                                        <td>@{{ ticket.created_at | date }}</td>
                                        <td>
                                            <button class="btn btn-primary mr-1" ng-click="modalEditar(ticket.id)"><span
                                                    data-toggle="tooltip" data-placement="top" title="Ver Ticket"><i
                                                        class="far fa-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                @{{ ticketsVencidos.length }} Registros
                            </div>
                            <div class="btn-toolbar" role="toolbar" aria-label="Calimax">
                                <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination"
                                    on-page-change="pageChangeHandler(newPageNumber)">
                                </dir-pagination-controls>
                            </div>
                        </div>

                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="seccion5">

                    <div class="m-2">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center" id="tbl_tickets">
                                <thead class="">
                                    <tr class="">
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> No Ticket </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Tipo </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Proyecto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asunto </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Asignado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Estado </a></th>
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Prioridad </a></th>
                                        {{-- <th><a class="text-body" href="#"
                                            ng-click="sortType = 'id'; sortReverse = !sortReverse"> Progreso </a></th> --}}
                                        <th><a class="text-body" href="#"
                                                ng-click="sortType = 'id'; sortReverse = !sortReverse"> Fecha </a></th>
                                        <th>Opc.</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="ticketsCerrados.length == 0">
                                        <td class="text-center" colspan="9">Sin datos guardados</td>
                                    </tr>

                                    <tr ng-model="ticketsCerrados"
                                        dir-paginate="ticket in datosFiltrados = (ticketsCerrados|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize"
                                        current-page="currentPage" pagination-id="itemsPagination">
                                        <td><a class="text-body font-weight-bold" href=""
                                                ng-click="moduloProv('{{ Crypt::encrypt(session('modulo_id')) }}',ticket.id)">@{{ ticket.id }}</a>
                                        </td>
                                        <td>@{{ ticket.tipo.descripcion }}</td>
                                        <td>@{{ ticket.proyecto.nombre }}</td>
                                        <td>@{{ ticket.titulo }}</td>
                                        <td>@{{ ticket.especialista.name }}</td>
                                        <td><span class="btn btn-secondary text-white"
                                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span></td>
                                        <td>@{{ ticket.prioridad.descripcion }}</td>
                                        {{-- <td>@{{ ticket.progreso }}</td> --}}
                                        <td>@{{ ticket.created_at | date }}</td>
                                        <td>
                                            <button class="btn btn-primary mr-1" ng-click="modalEditar(ticket.id)"><span
                                                    data-toggle="tooltip" data-placement="top" title="Ver Ticket"><i
                                                        class="far fa-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                @{{ ticketsCerrados.length }} Registros
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

        </div>
    </div>

    @include('includes.modals.gestiontickets_modals')

@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/requerimientos.js"></script>
@endpush
