var app = angular.module('roles', [ 'angularUtils.directives.dirPagination' ]);

app.controller( 'roles', function ($scope, $http, $httpParamSerializerJQLike) {
  $scope.currentPage = 1;
  $scope.pageSize = 11;
  $scope.user = {
    name: '',
    apellido: '',
    email: '',
    telefono: '',
    password: '',
    perfil: '',
    estatus: true,
  };

//   $http({
//     url: 'admin-user/getUsers',
//     method: 'GET',
//     headers: {
//       'Content-Type': 'application/json',
//       Accept: 'application/json',
//     },
//   }).then(
//     function successCallback(response) {
//       // console.log('salio bien: ', response);
//       $scope.usuarios = response.data.usuarios;
//       $scope.perfiles = response.data.perfiles;
//     },
//     function errorCallback(response) {
//       console.log('hubo error: ', response);
//       swal('titulo', 'mensaje', 'error');
//     }
//   );
//   $scope.modalNuevo = ()=>{
//     $scope.user = {
//       name: '',
//       apellido: '',
//       email: '',
//       telefono: '',
//       password: '',
//       perfil: '',
//       estatus: true,
//     };
//     $('#mdl_add_users').modal('show');
//   }

//   $scope.submitAgregar = (user) =>{
//     const regex = new RegExp("^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$");
    
//     if((user.perfil).trim() === ''){
//       return swal(titulos.admin_user, 'El campo perfil no debe estar vacío', 'warning');
//     }
//     if((user.name).trim() === ''){
//       return swal(titulos.admin_user, 'El campo nombre no debe estar vacío', 'warning');
//     }
//     if((user.apellido).trim() === ''){
//       return swal(titulos.admin_user, 'El campo apellido no debe estar vacío', 'warning');
//     }
//     if((user.email).trim() === ''){
//       return swal(titulos.admin_user, 'El campo correo no debe estar vacío', 'warning');
//     }

//     if (!(regex.test(user.email))) {
//       return swal(titulos.admin_user, 'Ingresa un correo válido', 'warning');
//     }

//     if((user.telefono).trim() === ''){
//       return swal(titulos.admin_user, 'El campo telefono no debe estar vacío', 'warning');
//     }
//     if((user.password).trim() === ''){
//       return swal(titulos.admin_user, 'El campo password no debe estar vacío', 'warning');
//     }

//     $http({
//       url: 'admin-user',
//       method: 'POST',
//       headers: {
//         'Content-Type': 'application/json',
//         Accept: 'application/json',
//       },
//       data: user
//     }).then(
//       function successCallback(response) {
//         // console.log('store bien: ', response);
//         const data = response.data;
//         $scope.usuarios = [...$scope.usuarios, data.usuario];
//         swal(titulos.admin_user, data.message, data.status);
//         $('#mdl_add_users').modal('hide');
//       },
//       function errorCallback(response) {
//         console.log('hubo error: ', response);
//         if (response.status === 422) {
//           let mensaje = '';
//           for (let i in response.data.errors) {
//               mensaje += response.data.errors[i] + '\n';
//           }
//           swal(titulos.admin_user, mensaje, 'error');
//         } else if( response.status === 419 ) {
//             swal(titulos.admin_user, "Su sesión ha vencido. Será redirigido a Home.", 'warning');
//             setTimeout(() => {
//                 $window.location.reload();
//             }, 2000);
//         } else {
//             swal(titulos.admin_user, response.data.message, 'error');
//         }
//       }
//     );
      
//   }
    
//   $scope.modalEditar = (id) => {
//     console.log(id);
//     $http({
//       url: `admin-user/${id}/edit`,
//       method: 'GET',
//       headers: {
//         'Content-Type': 'application/json',
//         Accept: 'application/json',
//       },
//     }).then(
//       function successCallback(response) {
//         // console.log('edit bien: ', response);
//         const data = response.data;
//         $scope.user = {
//           id: data.usuario.id,
//           name:  data.usuario.name,
//           apellido:  data.usuario.apellido,
//           email:  data.usuario.email,
//           telefono:  data.usuario.telefono,
//           // perfil:  data.usuario.perfil_id,
//           estatus: true,
//         };
//         $scope.perfil_selected = data.usuario.perfil_id -1;
//         // $("#perfil_edit option[value="+ data.usuario.perfil_id +"]").attr("selected",true);
       
//         $('#mdl_edit_users').modal('show');
//       },
//       function errorCallback(response) {
//         console.log('hubo error: ', response);
//         if (response.status === 422) {
//           let mensaje = '';
//           for (let i in response.data.errors) {
//               mensaje += response.data.errors[i] + '\n';
//           }
//           swal(titulos.admin_user, mensaje, 'error');
//         } else if( response.status === 419 ) {
//             swal(titulos.admin_user, "Su sesión ha vencido. Será redirigido a Home.", 'warning');
//             setTimeout(() => {
//                 $window.location.reload();
//             }, 2000);
//         } else {
//             swal(titulos.admin_user, response.data.message, 'error');
//         }
//       }
//     );
      
//   }

//   $scope.submitActualizar = (user) =>{
//     user.perfil = $('#perfil_edit').val();
//     console.log(user);
//     $http({
//       url: 'admin-user',
//       method: 'PUT',
//       headers: {
//         'Content-Type': 'application/json',
//         Accept: 'application/json',
//       },
//       data: user
//     }).then(
//       function successCallback(response) {
//         // console.log('put bien: ', response);
//         const data = response.data;
//         usuariosFiltro = $scope.usuarios.filter(usuario => usuario.id !== data.usuario.id);
//         $scope.usuarios = [...usuariosFiltro, data.usuario];
//         swal(titulos.admin_user, data.message, data.status);
//         $('#mdl_edit_users').modal('hide');
//       },
//       function errorCallback(response) {
//         console.log('hubo error: ', response);
//         if (response.status === 422) {
//           let mensaje = '';
//           for (let i in response.data.errors) {
//               mensaje += response.data.errors[i] + '\n';
//           }
//           swal(titulos.admin_user, mensaje, 'error');
//         } else if( response.status === 419 ) {
//             swal(titulos.admin_user, "Su sesión ha vencido. Será redirigido a Home.", 'warning');
//             setTimeout(() => {
//                 $window.location.reload();
//             }, 2000);
//         } else {
//             swal(titulos.admin_user, response.data.message, 'error');
//         }
//       }
//     );
//   }

//   $scope.eliminar = (id)=>{
//     swal({
//       title: '¿Seguro quieres eliminar este usuario?',
//       text: 'Una vez eliminado, ya no podrás recuperarlo.',
//       icon: 'warning',
//       buttons: ['Cancelar', 'Eliminar'],
//       dangerMode: true,
//     }).then((willDelete) => {
//       if (willDelete) {
//         $http({
//           url: 'admin-user/' + id,
//           method: 'DELETE',
//           headers: {
//             'Content-Type': 'application/json',
//           },
//         }).then(
//           function successCallback(response) {
//             let data = response.data;
//             $scope.usuarios = $scope.usuarios.filter(usuario => usuario.id !== data.usuario.id);
//             swal(titulos.admin_user , data.message, data.status); 
//           },
//           function errorCallback(response) {
//             desactivarLoading();
//             console.log(response);
//             if (response.status === 422) {
//               let mensaje = '';
//               for (let i in response.data.errors) {
//                   mensaje += response.data.errors[i] + '\n';
//               }
//               swal(titulos.admin_user, mensaje, 'error');
//             } else if( response.status === 419 ) {
//                 swal(titulos.admin_user, "Su sesión ha vencido. Será redirigido a Home.", 'warning');
//                 setTimeout(() => {
//                     $window.location.reload();
//                 }, 2000);
//             } else {
//                 swal(titulos.admin_user, response.data.message, 'error');
//             }
//           },
//         )
//       }
//     })

//   }

//   $scope.modalRestPssword = (usuario) =>{
//     // console.log(usuario);
//     $scope.user = {
//       id: usuario.id,
//       name: usuario.name +' '+ usuario.apellido,
//       email: usuario.email
//     }
//     $('#restablecer_password').modal('show');
//   }

//   $scope.restablecerPassword = (user) =>{
//     // return console.log(user);
//     $http({
//       url: 'admin-user/reset-password',
//       method: 'POST',
//       headers: {
//         'Content-Type': 'application/json',
//       },
//       data: user,
//     }).then(
//       function successCallback(response) {
//         // console.log(response);
//         let data = response.data;
//         swal(titulos.admin_user , data.message, data.status); 
//         $('#restablecer_password').modal('hide');
//       },
//       function errorCallback(response) {
//         console.log(response);
//         if (response.status === 422) {
//           let mensaje = '';
//           for (let i in response.data.errors) {
//               mensaje += response.data.errors[i] + '\n';
//           }
//           swal(titulos.admin_user, mensaje, 'error');
//         } else if( response.status === 419 ) {
//             swal(titulos.admin_user, "Su sesión ha vencido. Será redirigido a Home.", 'warning');
//             setTimeout(() => {
//                 $window.location.reload();
//             }, 2000);
//         } else {
//             swal(titulos.admin_user, response.data.message, 'error');
//         }
//       },
//     )
//   }


})