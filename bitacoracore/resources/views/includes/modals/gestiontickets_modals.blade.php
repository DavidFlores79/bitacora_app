<!-- GUARDAR TICKET -->
<div class="modal fade" id="mdl_add_tickets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <form class="was-validated" id="new-ticket" name="new-ticket" ng-submit="submitAgregar()">
                    <div class="card-header d-flex justify-content-between">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item ">
                                <a class="nav-link active" href="#seccion1" role="tab"
                                    data-toggle="tab">Atención</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#seccion2" role="tab" data-toggle="tab">Mensaje</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#seccion3" role="tab" data-toggle="tab">Datos
                                    cliente</a>
                            </li>
                        </ul>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body tab-content" style="min-height: 300px">
                        <div role="tabpanel" class="tab-pane active" id="seccion1">
                            <div class="row">
                                <div class="col-12 col-md-3 px-2 py-2">
                                    <label for="proyecto" class="form-label">Proyecto</label>
                                    <select id="proyecto" class="form-control form-control-sm" name="proyecto">
                                        <option ng-repeat="proyecto in proyectos" value="@{{ proyecto.id }}">
                                            @{{ proyecto.nombre }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 px-2 py-2">
                                    <label for="tipo" class="form-label">Tipo</label>
                                    <select id="tipo" class="form-control form-control-sm" name="tipo">
                                        <option ng-repeat="ticket_tipo in ticket_tipos" value="@{{ ticket_tipo.id }}">
                                            @{{ ticket_tipo.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 px-2 py-2">
                                    <label for="grupo" class="form-label">Grupo</label>
                                    <select id="grupox" class="form-control form-control-sm" name="grupo"
                                        ng-click="selectEspecialista()">
                                        <option ng-repeat="grupo in grupos" value="@{{ grupo.id }}">
                                            @{{ grupo.nombre }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 px-2 py-2">
                                    <label for="especialista" class="form-label">Especialista</label>
                                    <select id="especialista" class="form-control form-control-sm" name="especialista">
                                        <option ng-repeat="responsable in responsables" value="@{{ responsable.id }}">
                                            @{{ responsable.name }}</option>
                                    </select>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-12 col-md-3 px-2 py-2">
                                    <label for="categoria" class="form-label">Categoria</label>
                                    <select id="categoriax" class="form-control form-control-sm" name="categoria"
                                        ng-click="selectServicio()">
                                        <option ng-repeat="categoria in categorias" value="@{{ categoria.id }}">
                                            @{{ categoria.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 px-2 py-2">
                                    <label for="servicio" class="form-label">Servicio</label>
                                    <select id="servicio" class="form-control form-control-sm" name="servicio">
                                        <option ng-repeat="service in services" value="@{{ service.id }}">
                                            @{{ service.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 px-2 py-2">
                                    <label for="prioridad" class="form-label">Prioridad</label>
                                    <select id="prioridad" class="form-control form-control-sm" name="prioridad">
                                        <option ng-repeat="prioridad in prioridades" value="@{{ prioridad.id }}">
                                            @{{ prioridad.descripcion }}</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="seccion2">
                            <div class="row mb-3">
                                <div class="col-12 col-md-12 px-2 py-2">
                                    <label for="asunto-add" class="form-label">Asunto</label>
                                    <input id="asunto-add" type="text" class="form-control required" maxlength="255"
                                        required placeholder="Ingrese Asunto" name="asunto">
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-12 col-md-12 px-2 py-2">
                                    <label for="descripcion-add" class="form-label">Descripcion</label>
                                    <textarea name="descripcion" class="form-control form-control-sm no-resize required" id="descripcion-add"
                                        placeholder="Ingrese Descripción" rows="3"></textarea>
                                </div>
                            </div> --}}

                            <div id="editor" style="height: 300px">

                            </div>


                            <div class="form-group mt-2">
                                <input type="file" name="avatar" id="avatar" accept="image/*">
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="seccion3">
                            <div class="row">
                                <div class="col-12 col-md-6 px-2 py-2">
                                    <label for="usuario-add" class="form-label">Usuario</label>
                                    <input id="usuario-add" type="text" class="form-control"
                                        value="{{ auth()->user()->name . ' ' . auth()->user()->apellido }}" disabled>
                                </div>
                                <div class="col-12 col-md-6 px-2 py-2">
                                    <label for="perfil-add" class="form-label">Perfil</label>
                                    <input id="perfil-add" type="text" class="form-control"
                                        value="{{ auth()->user()->miPerfil->nombre }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 px-2 py-2">
                                    <label for="email-add" class="form-label">Email</label>
                                    <input id="email-add" type="email" class="form-control required" maxlength="255"
                                        required name="email" placeholder="ejemplo@hope.com"
                                        value="{{ auth()->user()->email }}">
                                </div>
                                <div class="col-12 col-md-6 px-2 py-2">
                                    <label for="tel-add" class="form-label">Telefono</label>
                                    <input type="number" class="form-control required" id="tel-add" required
                                        name="tel" placeholder="Ingrese telefono (10 digitos)"
                                        value="{{ auth()->user()->telefono }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start m-1">
                        <button type="submit" class="btn btn-primary col-1 m-1"><i class="fas fa-save"></i></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- VISUALIZAR TICKET -->
<div class="modal fade" id="mdl_edit_tickets" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item ">
                            <a class="nav-link active" href="#seccion1edit" role="tab"
                                data-toggle="tab">Atención</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#seccion2edit" role="tab" data-toggle="tab">Mensaje</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#seccion3edit" role="tab" data-toggle="tab">Datos
                                cliente</a>
                        </li>
                    </ul>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="card-body tab-content" style="min-height: 300px">
                    <div role="tabpanel" class="tab-pane active" id="seccion1edit">
                        <div class="row">
                            <div class="col-12 col-md-3 px-2 py-2">
                                <label for="proyecto-view" class="form-label">Proyecto</label>
                                <select disabled id="proyecto-view" class="form-control form-control-sm"
                                    name="proyecto">
                                    <option value="1">@{{ ticket.proyecto.nombre }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 px-2 py-2">
                                <label for="tipo-view" class="form-label">Tipo</label>
                                <select disabled id="tipo-view" class="form-control form-control-sm" name="tipo">
                                    <option value="1">@{{ ticket.tipo.descripcion }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 px-2 py-2">
                                <label for="grupo-view" class="form-label">Grupo</label>
                                <select disabled id="grupo-view" class="form-control form-control-sm" name="grupo">
                                    <option value="1">@{{ ticket.especialista.mi_perfil.nombre }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 px-2 py-2">
                                <label for="especialista-view" class="form-label">Especialista</label>
                                <select disabled id="especialista-view" class="form-control form-control-sm"
                                    name="especialista">
                                    <option value="1">@{{ ticket.especialista.name }}</option>
                                </select>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-12 col-md-3 px-2 py-2">
                                <label for="categoria-view" class="form-label">Categoria</label>
                                <select disabled id="categoria-view" class="form-control form-control-sm"
                                    name="categoria">
                                    <option value="1">@{{ ticket.servicio.categoria.descripcion }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 px-2 py-2">
                                <label for="servicio-view" class="form-label">Servicio</label>
                                <select disabled id="servicio-view" class="form-control form-control-sm"
                                    name="servicio">
                                    <option value="1">@{{ ticket.servicio.descripcion }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 px-2 py-2">
                                <label for="prioridad-view" class="form-label">Prioridad</label>
                                <select disabled id="prioridad-view" class="form-control form-control-sm"
                                    name="prioridad">
                                    <option value="1">@{{ ticket.prioridad.descripcion }}</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="seccion2edit">
                        <div class="row">
                            <div class="col-12 col-md-12 px-2 py-2">
                                <label for="asunto-view" class="form-label">Asunto</label>
                                <input disabled id="asunto-view" type="text" class="form-control" maxlength="255"
                                    required placeholder="Ingrese Asunto" name="asunto"
                                    value="@{{ ticket.titulo }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 px-2 py-2">
                                <label for="descripcion-view" class="form-label">Descripcion</label>
                                <textarea disabled name="descripcion" class="form-control form-control-sm no-resize" id="descripcion-view"
                                    placeholder="Ingrese Descripción" rows="3">@{{ ticket.descripcion }}</textarea>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <input type="file" name="avatar" id="avatar" accept="image/*">
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="seccion3edit">
                        <div class="row">
                            <div class="col-12 col-md-6 px-2 py-2">
                                <label for="usuario-view" class="form-label">Usuario</label>
                                <input disabled id="usuario-view" type="text" class="form-control"
                                    value="{{ auth()->user()->name . ' ' . auth()->user()->apellido }}" disabled>
                            </div>
                            <div class="col-12 col-md-6 px-2 py-2">
                                <label for="perfil-view" class="form-label">Perfil</label>
                                <input id="perfil-view" type="text" class="form-control"
                                    value="{{ auth()->user()->miPerfil->nombre }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 px-2 py-2">
                                <label for="email-view" class="form-label">Email</label>
                                <input disabled id="email-view" type="email" class="form-control" maxlength="255"
                                    required name="email" placeholder="ejemplo@hope.com"
                                    value="@{{ ticket.email }}">
                            </div>
                            <div class="col-12 col-md-6 px-2 py-2">
                                <label for="tel-view" class="form-label">Telefono</label>
                                <input disabled type="text" class="form-control" id="tel-view" required
                                    name="tel" placeholder="Ingrese telefono (10 digitos)"
                                    value="@{{ ticket.telefono }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <p class="mr-2 mb-2">Ticket no @{{ ticket.id }} - @{{ ticket.created_at | date }}</p>
                </div>
            </div>

        </div>
    </div>
</div>
