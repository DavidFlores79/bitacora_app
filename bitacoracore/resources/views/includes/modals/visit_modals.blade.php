<!-- Modal Registrar Entrada  -->
<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregarModalLabel">Ingresar @yield('page-title')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createForm" ng-submit="store()" class="was-validated">
          <div class="row">
            <div class="col-md-6">
              <label for="imagen_placas" class="form-label">Placas</label>
              <!-- <input class="form-control" type="file" id="imagen_placas" custom-on-change="uploadFilePlacas" accept="image/png, image/jpg, image/jpeg" required> -->
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagen_placas" custom-on-change="uploadFilePlacas" accept="image/png, image/jpg, image/jpeg" required>
                <label class="custom-file-label" for="xml">Escoger Archivo...</label>
              </div>
              <div class="m-3" id="imagen_placas_preview"></div>
            </div>
            <div class="col-md-6">
              <label for="imagen_identificacion" class="form-label">INE</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagen_identificacion" custom-on-change="uploadFileId" accept="image/png, image/jpg, image/jpeg" required>
                <label class="custom-file-label" for="xml">Escoger Archivo...</label>
              </div>
              <!-- <input class="form-control" type="file" id="imagen_identificacion" custom-on-change="uploadFileId" accept="image/png, image/jpg, image/jpeg" required> -->
              <div class="m-3" id="imagen_identificacion_preview"></div>
            </div>
            <div class="col-md-12 py-2">
              <label for="servicio_id" class="form-label">Servicio(s)</label>
              <select ng-model="createForm.servicio_id" ng-disabled="servicios.length <= 0" name="servicio_id" id="servicio_id" class="form-control" ng-change="constarSalidas()" title="Selecciona un servicio" required autofocus>
                <option value="">Filtra por servicio...</option>
                <!-- <option value="@{{ servicio.id }}" ng-repeat="servicio in servicios"> @{{ servicio.nombre }}</option> -->
                @if(auth()->user()->miPerfil->codigo == 'superuser')
                <option value="@{{servicio.id}}" ng-repeat="servicio in servicios">@{{servicio.nombre}}</option>
                @else if(auth()->user()->miPerfil->codigo == 'client')
                <option value="@{{servicio.id}}" ng-repeat="servicio in misServicios">@{{servicio.nombre}}</option>
                @endif
              </select>
            </div>
            <div class="col-md-6 py-2">
              <label for="visitante" class="form-label">Visitante</label>
              <input type="text" class="form-control required" id="visitante" ng-model="createForm.visitante" maxlength="255" required>
            </div>
            <div class="col-md-6 py-2">
              <label for="quien_visita" class="form-label">Quien Visita</label>
              <input type="text" class="form-control required" id="quien_visita" ng-model="createForm.quien_visita" maxlength="255" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 py-2">
              <label for="email" class="form-label">Motivo de Visita</label>
              <textarea class="form-control" name="motivo_visita" id="motivo_visita" ng-model="createForm.motivo_visita" rows="3" required></textarea>
            </div>
            <div class="col-md-12 py-2">
              <label for="tipo_vehiculo" class="form-label">Tipo de Vehículo</label>
              <select id="tipo_vehiculo" class="form-control" ng-model="createForm.tipo_vehiculo" required>
                <option value="" disabled>Selecciona...</option>
                <option ng-repeat="tipo_vehiculo in tipos_vehiculo" value="@{{ tipo_vehiculo.id }}">
                  @{{ tipo_vehiculo.nombre }}</option>
              </select>
            </div>
          </div>
          <div class="form-group py-2">
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
              <label for="nombre_edit" class="form-label">Nombre</label>
              <input type="text" class="form-control required" id="nombre_edit" ng-model="dato.nombre" maxlength="255" required>
            </div>
            <div class="col-md-6 py-2">
              <label for="apellido_edit" class="form-label">Apellido</label>
              <input type="text" class="form-control required" id="apellido_edit" ng-model="dato.apellido" maxlength="255" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="perfil_edit" class="form-label">Perfil del Usuario</label>
              <select id="perfil_edit" class="form-control" required>
                <option value="" disabled>Selecciona un perfil</option>
                <option ng-selected="perfil_selected" ng-repeat="perfil in perfiles" value="@{{ perfil.id }}">
                  @{{ perfil.nombre }}</option>
              </select>
            </div>
            <div class="col-md-6 py-2">
              <label for="nickname_edit" class="form-label">Nickname</label>
              <input type="text" class="form-control required" id="nickname_edit" ng-model="dato.nickname" maxlength="255" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="telefono_edit" class="form-label">Telefono</label>
              <input id="telefono_edit" type="text" class="form-control" ng-model="dato.telefono" minlength="10" maxlength="10" pattern="^\d+$">
            </div>
            <div class="col-md-6 py-2">
              <label for="email_edit" class="form-label">Correo</label>
              <input id="email_edit" type="email" class="form-control" ng-model="dato.email" required>
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
        ¿Realmente desea eliminar <span class="font-weight-bold" id="nombre-dato"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" ng-click="delete(dato)">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Registrar Salida -->
<div class="modal fade" id="salidaModal" tabindex="-1" aria-labelledby="salidaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="salidaModalLabel">Salida de @yield('page-title')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column align-items-center">
          <div>¿Realmente desea dar salida a este vehículo?</div>
          <div class="">
            <span class="font-weight-bold">Hora de salida: </span>
            <span>{{ date('d-M-Y H:i:s')  }}</span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" ng-click="registrarSalida(dato)">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Registrar Incidencia -->
<div class="modal fade" id="incidenciaModal" tabindex="-1" aria-labelledby="incidenciaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incidenciaModalLabel">Registro de Incidencia <span ng-if="dato">de la Visita <span class="font-weight-bold">@{{ dato.id }}</span> </span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createIncidencia" ng-submit="registrarIncidencia()" class="was-validated">
          <div class="row">
            <div class="col-md-12 py-2">
              <p ng-if="dato" class="">Esta visita fue registrada en <span class="font-weight-bold">@{{fixDate(dato.fecha_entrada) | date:'MMM d, y h:mm:ss a' }}</span> por <span class="font-weight-bold">@{{ dato.user.nombre }} @{{ dato.user.apellido }}</span></p>
            </div>
            <div class="col-md-12 py-2">
              <label for="email" class="form-label">Describa lo mejor posible la situación:</label>
              <textarea class="form-control" name="descripcion" id="descripcion" ng-model="createIncidencia.descripcion" rows="3" required title="Debe describir el motivo de la incidencia"></textarea>
              <small ng-if="!dato">* Se registrará como incidencia general. Si desea registrar una incidencia relacionada con una visita favor de hacerlo desde el detalle de la visita.</small>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" ng-click="registrarIncidencia()">Guardar</button>
      </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal Detalles -->
<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallesModalLabel">Detalles del Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 py-2">
            <img class="detalle-imagen" ng-if="!dato.imagen_identificacion.includes('data:image/')" ng-click="show(dato)" data-ng-src="data:image/png;base64,@{{dato.imagen_identificacion}}" />
            <img class="detalle-imagen" ng-if="dato.imagen_identificacion.includes('data:image/')" ng-click="show(dato)" data-ng-src="@{{dato.imagen_identificacion}}" />
          </div>
          <div class="col-md-6 py-2">
            <img class="detalle-imagen" ng-if="!dato.placas.includes('data:image/')" ng-click="show(dato)" data-ng-src="data:image/png;base64,@{{dato.placas}}" />
            <img class="detalle-imagen" ng-if="dato.placas.includes('data:image/')" ng-click="show(dato)" data-ng-src="@{{dato.placas}}" />
          </div>
        </div>
        <!-- <img class="detalle-imagen" data-ng-src="data:image/png;base64,@{{dato.imagen_identificacion}}" /> -->
        <div class="table-responsive mt-4">
          <table class="table">
            <tbody>
              <tr>
                <th colspan="2">Visitante</th>
                <td colspan="2">@{{ dato.nombre_visitante }}</td>
              </tr>
              <tr>
                <th colspan="2">Quien Visita</th>
                <td colspan="2">@{{ dato.nombre_quien_visita }}</td>
              </tr>
              <tr>
                <th colspan="2">Motivo</th>
                <td colspan="2">@{{dato.motivo_visita}}</td>
              </tr>
              <tr>
                <th>Tipo de Vehículo</th>
                <td><i ng-class="{2:'fas fa-motorcycle fa-2x moto', 1:'fas fa-car-side fa-2x carro', 3:'fas fa-truck-moving fa-2x camion'}[dato.tipo_vehiculo_id]"></i></td>
                <th>Recibió</th>
                <td>@{{dato.user.nombre}} @{{dato.user.apellido}} | @{{ dato.servicio.nombre }}</td>
              </tr>
              <tr>
                <th>Fecha Entrada</th>
                <td>@{{fixDate(dato.fecha_entrada) | date:'MMM d, y h:mm:ss a' }}</td>
                <th>Fecha Salida</th>
                <td>@{{fixDate(dato.fecha_salida) | date:'MMM d, y h:mm:ss a' }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mx-3">
          <div class="" ng-if="dato.incidencias.length > 0" >
            <div class="text-center my-3 font-weight-bold">Incidencias relacionadas</div>
            <table class="table table-striped">
              <thead class="etiquetas">
                <tr>
                  <th scope="col">Descrición</th>
                  <th scope="col">Fecha</th>
                </tr>
              </thead>
              <tbody>
                <tr class="etiquetas" ng-repeat="incidencia in dato.incidencias track by $index">
                  <td>@{{incidencia.descripcion}}</td>
                  <td>@{{fixDate(incidencia.created_at) | date:'MMM d, y h:mm:ss a' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <a href="" ng-click="modalIncidencia(dato)">Registrar Incidencia</a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>