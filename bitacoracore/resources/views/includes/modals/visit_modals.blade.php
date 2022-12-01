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
              <input id="telefono" type="text" class="form-control" ng-model="createForm.telefono" minlength="10" maxlength="10" pattern="^\d+$">
            </div>
            <div class="col-md-6 py-2">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" ng-model="createForm.password" required placeholder="Mínimo 6 caracteres" minlength="6" maxlength="255">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" ng-click="delete(dato)">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detalles -->
<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallesModalLabel">Detalles del Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="detalle-imagen" data-ng-src="data:image/png;base64,@{{dato.imagen_identificacion}}" />
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
                <th>Placas</th>
                <td>@{{dato.placas | uppercase}}</td>
              </tr>
              <tr>
                <th colspan="2">Recibió</th>
                <td colspan="2">@{{dato.user.nombre}} @{{dato.user.apellido}} | @{{ dato.servicio.nombre }}</td>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>