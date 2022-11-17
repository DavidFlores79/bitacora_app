{{-- GUARDAR USUARIOS --}}
<div class="modal fade" id="mdl_add_users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="was-validated" id="formCreate" name="formCreate" ng-submit="submitAgregar(user)">
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control required" id="nombre" ng-model="user.name" maxlength="255"
                required>
            </div>
            <div class="col-md-6 py-2">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control required" id="apellido" ng-model="user.apellido" maxlength="255"
                required>
            </div>

          </div>
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="perfil" class="form-label">Perfil del Usuario</label>
              <select id="perfil" class="form-control" ng-model="user.perfil" required>
                <option value="" disabled>Selecciona un perfil</option>
                <option ng-repeat="perfil in perfiles" value="@{{ perfil.id }}">
                  @{{ perfil.nombre }}</option>
              </select>
            </div>
            <div class="col-md-6 py-2">
              <label for="email" class="form-label">Correo</label>
              <input id="email" type="email" class="form-control" ng-model="user.email" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="telefono" class="form-label">Telefono</label>
              <input id="telefono" type="text" class="form-control" ng-model="user.telefono" minlength="10"
                maxlength="10" pattern="^\d+$" required>
            </div>
            <div class="col-md-6 py-2">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" ng-model="user.password" required
                placeholder="Mínimo 8 caracteres" minlength="8" maxlength="255">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- EDITAR USUARIOS --}}
<div class="modal fade" id="mdl_edit_users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="was-validated" id="formEdit" name="formEdit" ng-submit="submitActualizar(user)">
          <div class="row">
            <div class="col-md-12 py-2">
              <label for="perfil_edit" class="form-label">Perfil del Usuario</label>
              <select id="perfil_edit" class="form-control" required>
                <option value="" disabled>Selecciona un perfil</option>
                <option ng-selected="perfil_selected" ng-repeat="perfil in perfiles" value="@{{ perfil.id }}">
                  @{{ perfil.nombre }}</option>
              </select>
            </div>
          </div>
          <input type="text" name="id" id="id" ng-model="user.id" class="d-none">
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="nombre_edit" class="form-label">Nombre</label>
              <input type="text" class="form-control required" id="nombre_edit" ng-model="user.name" maxlength="255"
                required>
            </div>
            <div class="col-md-6 py-2">
              <label for="apellido_edit" class="form-label">Apellido</label>
              <input type="text" class="form-control required" id="apellido_edit" ng-model="user.apellido" maxlength="255"
                required>
            </div>

          </div>
          <div class="row">
            <div class="col-md-6 py-2">
              <label for="telefono_edit" class="form-label">Telefono</label>
              <input id="telefono_edit" type="text" class="form-control" ng-model="user.telefono" minlength="10"
              maxlength="10" pattern="^\d+$" required>
            </div>
            <div class="col-md-6 py-2">
              <label for="email_edit" class="form-label">Correo</label>
              <input id="email_edit" type="email" class="form-control" ng-model="user.email" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- RESTABLECER CONTRASEÑAS USUARIOS --}}
<div class="modal fade" id="restablecer_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restablecer Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="was-validated" id="formRestablecer" name="formRestablecer" ng-submit="restablecerPassword(user)">
          <input type="text" class="d-none" id="id_usuario" ng-model="user.id">
          <div class="row">
            <div class="col-md-12 py-2">
              <label for="nombre-restablecer" class="form-label">Nombre</label>
              <input type="text" class="form-control required" id="nombre-restablecer" ng-model="user.name" disabled>
            </div>
            <div class="col-md-12 py-2">
              <label for="usuario-restablecer" class="form-label">Correo</label>
              <input id="usuario-restablecer" type="text" class="form-control" ng-model="user.email" disabled>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 py-2">
              <label for="password-edit" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password-edit" ng-model="user.password" required
                placeholder="Mínimo 8 caracteres" minlength="8" maxlength="255">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>