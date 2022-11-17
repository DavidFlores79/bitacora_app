@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Gestion de Tickets')
@section('ngApp', 'gestiontickets')
@section('ngController', 'gestiontickets')

@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid mt-3 col-11">


        <div class="card shadow">
            <div class="card-header bg-white d-flex justify-content-between">
                <h6 class="mt-1">Mis Tickets</h6>
                <button data-toggle="tooltip" data-placement="top" title="Agregar ticket"
                    class="btn btn-success d-flex justify-content-center align-items-center" ng-click="modalNuevo()">
                    <i class="fas fa-address-card"></i>
                </button>
            </div>
            <div class="card-body">

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
                                <td>@{{ ticket.id }}</td>
                                <td>@{{ ticket.tipo.descripcion }}</td>
                                <td>@{{ ticket.proyecto.nombre }}</td>
                                <td>@{{ ticket.titulo }}</td>
                                <td>@{{ ticket.especialista.name }}</td>
                                <td>@{{ ticket.estatus.descripcion }}</td>
                                <td>@{{ ticket.prioridad.descripcion }}</td>
                                {{-- <td>@{{ ticket.progreso }}</td> --}}
                                <td>@{{ ticket.created_at | date }}</td>
                                <td class="d-flex">
                                    <button class="btn btn-primary mr-1" ng-click="modalEditar(ticket.id)"><span
                                            data-toggle="tooltip" data-placement="top" title="Ver Ticket"><i class="far fa-eye"></i></button>
                                    <button class="btn btn-danger" ng-click="eliminar(ticket.id)"><span
                                            data-toggle="tooltip" data-placement="top" title="Eliminar Ticket"><i
                                                class="fas fa-trash-alt"></i></button>
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

    </div>

    @include('includes.modals.gestiontickets_modals')

@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/gestion-tickets.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>

    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        var toolbarOptions = [
            [{
                'size': ['small', false, 'large', 'huge', ]
            }], // custom dropdown
            // [{
            //     'header': [1, 2, 3, 4, 5, 6, false]
            // }],
            ['bold', 'italic', 'underline'], // toggled buttons

            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],



            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            [ 'image', 'clean'] // remove formatting button
        ];
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }


        });
    </script>
@endpush
