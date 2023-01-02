@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Visitantes')
@section('ngApp', 'visitas')
@section('ngController', 'visitas')

@section('content')

<div class="container-fluid mt-3 col-11">

  <div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between">
      <div class="col-md-8 col-sm-4">
        <h6 class="mt-1">@yield('page-title')</h6>
      </div>
      <div class="col-md-4 col-sm-8">
        <select ng-model="searchQuery.servicio_id" ng-disabled="servicios.length <= 0" name="servicio_selected" id="servicio_selected" class="form-control" ng-change="constarSalidas()" required autofocus>
          <option value="">Filtra por servicio...</option>
          <!-- <option value="@{{ servicio.id }}" ng-repeat="servicio in servicios"> @{{ servicio.nombre }}</option> -->
          @if(auth()->user()->miPerfil->codigo == 'superuser')
            <option value="@{{servicio.id}}" ng-repeat="servicio in servicios">@{{servicio.nombre}}</option>
          @else if(auth()->user()->miPerfil->codigo == 'client')
            <option value="@{{servicio.id}}" ng-repeat="servicio in misServicios">@{{servicio.nombre}}</option>
          @endif
        </select>
      </div>
    </div>
    <div class="card-body">
      <div class="mb-3 d-flex justify-content-around">
        <button data-toggle="tooltip"
                data-placement="top" 
                title="Autos que ingresaron" 
                onmouseenter="$(this).tooltip('show')" 
                class="btn btn-info btn-sm">
          <div class="etiquetas">@{{ datosFiltrados.length }}</div>
          <div><i class="fas fa-car"></i></div>
          <div class="etiquetas">Ingresaron</div>
        </button>
        <button data-toggle="tooltip"
                data-placement="top" 
                title="Autos pendientes por salir" 
                onmouseenter="$(this).tooltip('show')" 
                class="btn btn-danger btn-sm">
          <div class="etiquetas" id="cuantasSalidas"></div>
          <i class="fas fa-car-side"></i>
          <div class="etiquetas">Por Salir</div>
        </button>
        <button data-toggle="tooltip"
                data-placement="top" 
                title="Entrada de Vehículos" 
                onmouseenter="$(this).tooltip('show')" 
                class="btn btn-success btn-sm"
                ng-click="create()">
          <div class="etiquetas" id="cuantasSalidas"></div>
          <i class="fas fa-car"></i>
          <div class="etiquetas">Registro</div>
          <div class="etiquetas">de Visitas</div>
        </button>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
          <thead class="">
            <tr class="">
              </th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.imagen_identificacion'; sortReverse = !sortReverse"> INE </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.placas'; sortReverse = !sortReverse"> Placas </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre_datonte'; sortReverse = !sortReverse"> Visitante </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.nombre_quien_dato'; sortReverse = !sortReverse"> A Quien Visita </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.motivo_dato'; sortReverse = !sortReverse"> Motivo </a>
              </th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.tipo_vehiculo_id'; sortReverse = !sortReverse"> Tipo </a></th>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.user_id'; sortReverse = !sortReverse"> Recibió </a>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.fecha_entrada'; sortReverse = !sortReverse"> Entrada </a>
              <th><a class="text-body" href="#" ng-click="sortType = 'dato.fecha_salida'; sortReverse = !sortReverse"> Salida </a>
                <!-- <th><a class="text-body" href="#" ng-click="sortType = 'dato.app_id'; sortReverse = !sortReverse"> AppId </a> -->
              <th>Opc.</th>

            </tr>
          </thead>
          <tbody>
            <tr dir-paginate="dato in datosFiltrados = (datos|filter:searchQuery|orderBy:sortType:sortReverse)|itemsPerPage:pageSize" current-page="currentPage" pagination-id="itemsPagination">
              <td>
                <img ng-click="show(dato)" src="{{ asset('assets/img/visits/ine.png') }}" alt="" class="imagen_id">
                <!-- <img class="imagen_id" ng-if="!dato.imagen_identificacion.includes('data:image/')" ng-click="show(dato)" data-ng-src="data:image/png;base64,@{{dato.imagen_identificacion}}" />
                <img class="imagen_id" ng-if="dato.imagen_identificacion.includes('data:image/')" ng-click="show(dato)" data-ng-src="@{{dato.imagen_identificacion}}" /> -->
              </td>
              <td>
              <img ng-click="show(dato)" src="{{ asset('assets/img/visits/placa.png') }}" alt="" class="imagen_id">
                <!-- <img class="imagen_id" ng-if="!dato.placas.includes('data:image/')" ng-click="show(dato)" data-ng-src="data:image/png;base64,@{{dato.placas}}" />
                <img class="imagen_id" ng-if="dato.placas.includes('data:image/')" ng-click="show(dato)" data-ng-src="@{{dato.placas}}" /> -->
              </td>
              <td style="min-width: 150px;">@{{ dato.nombre_visitante }}</td>
              <td style="min-width: 150px;">@{{ dato.nombre_quien_visita }}</td>
              <td style="min-width: 150px;">@{{ dato.motivo_visita }}</td>
              <td><i ng-class="{2:'fas fa-motorcycle fa-2x moto', 1:'fas fa-car-side fa-2x carro', 3:'fas fa-truck-moving fa-2x camion'}[dato.tipo_vehiculo_id]"></i></td>
              <!-- <td>@{{ dato.placas | uppercase }}</td> -->
              <td style="min-width: 120px;">@{{ dato.user.nombre }} @{{ dato.user.apellido }}</td>
              <td style="min-width: 120px;">@{{ fixDate(dato.fecha_entrada) | date:"yyyy-MM-dd '-' h:mma" }}</td>
              <td style="min-width: 120px;">@{{ fixDate(dato.fecha_salida) | date:"yyyy-MM-dd '-' h:mma" }}</td>
              <!-- <td>@{{ dato.app_id }}</td> -->
              <td class="d-flex justify-content-between">
                <button class="btn btn-info mr-2" ng-click="show(dato)"><span data-toggle="tooltip" data-placement="top" title="Detalles de la visita" onmouseenter="$(this).tooltip('show')"><i class="far fa-eye"></i></span></button>

                <button class="btn btn-primary mr-2" ng-click="edit(dato)"><span data-toggle="tooltip" data-placement="top" title="Editar visita" onmouseenter="$(this).tooltip('show')"><i class="fas fa-edit"></i></span></button>

                <button class="btn btn-danger mr-2" 
                        ng-disabled="dato.fecha_salida != null || dato.fecha_salida == ''" 
                        ng-click="confirmarSalida(dato)">
                  <span data-toggle="tooltip" data-placement="top" title="Dar Salida" onmouseenter="$(this).tooltip('show')">
                    <i class="fas fa-car-side"></i>
                  </span>
                </button>

                @if(auth()->user()->perfil_id == 1)
                  <button class="btn btn-danger mr-2" ng-click="confirmarEliminar(dato)"><span data-toggle="tooltip" data-placement="top" title="Eliminar dato" onmouseenter="$(this).tooltip('show')"><i class="fas fa-trash-alt"></i></span></button>
                @endif

              </td>
            </tr>
          </tbody>
        </table>
        <div class="btn-toolbar" role="toolbar" aria-label="Calimax">
          <dir-pagination-controls boundary-links="true" pagination-id="itemsPagination" on-page-change="pageChangeHandler(newPageNumber)">
          </dir-pagination-controls>
        </div>
      </div>
      <div class="text-right m-1">
          @{{ datosFiltrados.length }} Registros
        </div>
    </div>
  </div>

</div>

@include('includes.modals.visit_modals')

@endsection

@push('js')
<script src="{{ asset('assets') }}/js/visitas.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.serializejson.js"></script>
<script>
    $('#imagen_placas').on('change',function(){
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
    $('#imagen_identificacion').on('change',function(){
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endpush