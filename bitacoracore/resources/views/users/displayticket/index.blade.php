@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Ticket')
@section('ngApp', 'ticket')
@section('ngController', 'ticket')

@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <style>
        .ql-container.ql-snow {
            height: auto;
        }

        .ql-editor {
            height: 300px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid mb-2 ml-0 mt-1">
        <div class="d-flex justify-content-end mb-3">
            <button onclick="history.back()" class="btn btn-secondary d-flex justify-content-center align-items-center"
                data-toggle="tooltip" data-placement="top" title="Regresar" id="regresarPagina">
                Regresar <i class="ml-2 fas fa-arrow-left"></i>
            </button>
            <button ng-if="ticket.estatus_id != 1" class="btn btn-success mr-4 ml-2"
                ng-click="guardarSolucion(ticket)">Guardar <i class="fas fa-save"></i></button>
            <button ng-if="ticket.estatus_id == 1" class="btn btn-success mr-4 ml-2"
                ng-click="guardarSolucion(ticket)">Confirmar <i class="fas fa-check"></i></button>
        </div>
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-xl-0 mb-3">

                <div class="card shadow">

                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item ">
                                <a class="nav-link active" href="#seccion1" role="tab" data-toggle="tab">Datos
                                    Adicionales</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#seccion2" role="tab" data-toggle="tab">Historico</a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body tab-content">
                        <div role="tabpanel" class="tab-pane active" id="seccion1" style="height:405px">
                            <div class="m-2">
                                <div class="mt-1">
                                    <h6 class="heading-small text-muted mb-4">Datos del usuario</h6>
                                </div>
                                <div class="text-center text-muted">
                                    <span>Nombre: @{{ ticket.creador_ticket.name }} @{{ ticket.creador_ticket.apellido }}</span><br>
                                    <span>Correo: @{{ ticket.email }}</span><br>
                                    <span>Telefono: @{{ ticket.telefono }}</span><br>
                                </div>
                                <hr class="my-4" />
                                <div class="mt-1">
                                    <h6 class="heading-small text-muted mb-4">Progreso</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: @{{ ticket.progreso }}%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h6 class="heading-small text-muted mt-5">Tiempo Transcurrido</h6>
                                    <h4 class="text-center mt-4 text-muted"><i class="fas fa-stopwatch mr-3"></i>1h : 14min</h4>
                                </div>
                            </div>

                        </div>
                        <style>
                            .scroll::-webkit-scrollbar {
                                -webkit-appearance: none;
                            }

                            .scroll::-webkit-scrollbar:vertical {
                                width: 5px;
                            }

                            .scroll::-webkit-scrollbar-button:increment,
                            .scroll::-webkit-scrollbar-button {
                                display: none;
                            }

                            .scroll::-webkit-scrollbar:horizontal {
                                height: 5px;
                            }

                            .scroll::-webkit-scrollbar-thumb {
                                background-color: #E5E5E5;
                                border-radius: 20px;
                            }

                            .scroll::-webkit-scrollbar-track {
                                border-radius: 10px;
                            }
                        </style>
                        <div role="tabpanel" class="tab-pane scroll" id="seccion2" style="height:413px; overflow:auto;">

                            <div class="m-2">
                                <div ng-repeat="historial in ticket.ticket_historial" class="mb-3 text-muted">
                                    <div class="d-flex justify-content-between">
                                        <strong class="mr-auto">@{{ historial.accion_tipo.descripcion }}</strong>
                                        <small>@{{ historial.created_at | date }}</small>
                                    </div>
                                    <div>
                                        <small>@{{ historial.responsable.name }} @{{ historial.accion.nombre }} el ticket</small><br>
                                        <div ng-if="historial.accion.id == 2">
                                            <small class="mr-3"><b>Old:</b>
                                                @{{ historial.olduser.name }}</small><small><b>New:</b>
                                                @{{ historial.newuser.name }}</small>
                                        </div>
                                        <div ng-if="historial.accion.id != 1 && historial.accion.id != 2">
                                            <small class="mr-3"><b>Old:</b>
                                                @{{ historial.old }}</small><small><b>New:</b>
                                                @{{ historial.new }}</small>
                                        </div>
                                        <hr class="my-4" />
                                    </div>
                                </div>
                                <div ng-if="ticket.ticket_historial.length == 0" class="text-center">
                                    Sin Registros
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card  shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h4 class="mb-0 ml-3 mr-3 ">Ticket {{ $_GET['idticket'] }}</h4>
                            <span ng-if="ticket.estatus.id == estados.registrado" class="btn btn-secondary text-white p-0"
                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span>
                            <span ng-if="ticket.estatus.id == estados.en_proceso" class="btn btn-info text-white p-0"
                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span>
                            <span ng-if="ticket.estatus.id == estados.en_espera" class="btn btn-primary text-white p-0"
                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span>
                            <span ng-if="ticket.estatus.id == estados.asignado" class="btn btn-warning text-white p-0"
                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span>
                            <span ng-if="ticket.estatus.id == estados.resuelto" class="btn btn-success text-white p-0"
                                style=" cursor: text; width: 100px">@{{ ticket.estatus.descripcion }}</span>
                        </div>
                    </div>
                    <div class="card-body">

                        <h6 class="heading-small text-muted mb-3">Información del Ticket</h6>
                        <div class="row mb-3">

                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="proyecto" class="form-label">Proyecto</label>
                                <select id="proyecto" class="form-control form-control-sm" name="proyecto">
                                    <option value="@{{ proyecto.id }}" ng-repeat="proyecto in proyectos"
                                        ng-selected="ticket.proyecto_id == proyecto.id">@{{ proyecto.nombre }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="estatus" class="form-label">Estatus</label>
                                <select id="estatus" class="form-control form-control-sm" name="estatus">
                                    {{-- <option value="1" >@{{ ticket.estatus.descripcion }}</option> --}}
                                    <option value="@{{ est.id }}" ng-repeat="est in estatus"
                                        ng-selected="ticket.estatus_id == est.id">@{{ est.descripcion }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="seguimiento" class="form-label">Seguimiento</label>
                                <select disabled id="seguimiento" class="form-control form-control-sm" name="seguimiento">
                                    <option value="1">@{{ ticket.seguimiento.descripcion }}</option>
                                </select>
                            </div>

                        </div>

                        <h6 class="heading-small text-muted mb-3">Datos de Atención</h6>
                        <div class="row">
                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select id="categoria" class="form-control form-control-sm"
                                    name="categoria" ng-click="selectServicio()">
                                    <option value="@{{ categoria.id }}" ng-repeat="categoria in categorias"
                                        ng-selected="ticket.servicio.categoria.id == categoria.id">@{{ categoria.descripcion }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="servicio" class="form-label">Servicio</label>
                                <select id="servicio" class="form-control form-control-sm" name="servicio">
                                    <option ng-repeat="servicio in services" value="@{{ servicio.id }}"
                                        ng-selected="ticket.servicio_id == servicio.id">
                                        @{{ servicio.descripcion }}</option>
                                </select>

                            </div>
                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="prioridad" class="form-label">Prioridad</label>
                                <select id="prioridad" class="form-control form-control-sm" name="prioridad">
                                    <option value="@{{ prioridad.id }}" ng-repeat="prioridad in prioridades"
                                        ng-selected="ticket.prioridad_id == prioridad.id">@{{ prioridad.descripcion }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select id="tipo" class="form-control form-control-sm" name="tipo">
                                    <option value="@{{ tipo.id }}" ng-repeat="tipo in ticket_tipos"
                                        ng-selected="ticket.ticket_tipo_id == tipo.id">@{{ tipo.descripcion }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="grupo" class="form-label">Grupo</label>
                                <select id="grupo" class="form-control form-control-sm" name="grupo"
                                    ng-click="selectEspecialista()">
                                    <option value="@{{ grupo.id }}" ng-repeat="grupo in grupos"
                                        ng-selected="ticket.especialista.mi_perfil.id == grupo.id">@{{ grupo.nombre }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 px-2 py-2">
                                <label for="especialista" class="form-label">Especialista</label>
                                <select id="especialista" class="form-control form-control-sm" name="especialista">
                                    <option ng-repeat="responsable in responsables" value="@{{ responsable.id }}"
                                        ng-selected="ticket.especialista_id == responsable.id">
                                        @{{ responsable.name }}</option>
                                </select>
                            </div>


                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-12 px-2 py-2">
                                <label for="asunto-view" class="form-label">Asunto</label>
                                <input id="asunto-view" type="text" class="form-control" maxlength="255" required
                                    placeholder="Ingrese Asunto" name="asunto" readonly value="@{{ ticket.titulo }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">

                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item ">
                                <a class="nav-link active" href="#seccionMensaje" role="tab"
                                    data-toggle="tab">Mensaje</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#seccionSolucion" role="tab"
                                    data-toggle="tab">Solución</a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body tab-content">
                        <div role="tabpanel" class="tab-pane active" id="seccionMensaje">
                            <div class="m-2">
                                <div id="editor">
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="seccionSolucion">

                            <div class="m-2">

                                <div id="editor-solucion">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>








@endsection

@push('js')
    <script>
        var idTicket = "{{ $_GET['idticket'] }}";
    </script>

    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/screenfull.js/5.1.0/screenfull.min.js"></script>

    <script src="{{ asset('assets') }}/js/display-ticket.js"></script>

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

            ['image', 'clean'] // remove formatting button
        ];
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });
        quill.disable();

        var quill2 = new Quill('#editor-solucion', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });

    </script>
@endpush
