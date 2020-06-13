$(document).ready(function () {
     //nombre usuario y mensaje del usuario
     $.validator.addMethod(  "regex", function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
          },
          "Please check your input."
     );
     
     //CORREO ELECTRONICO
     $.validator.addMethod(  "emailRegex", function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
          },
          "Por favor ingrese un correo válido"
     );
     
     $('#formularioEditarUsuario').validate({
       rules: {
          edtNombreUsuario: {
               required: true,
               regex: /^([a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ]+[\s]*)+$/
          },
          edtApellidoUsuario: {
               required: true,
               regex: /^([a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ]+[\s]*)+$/
          },
          edtCorreoUsuario: {
               required: true,
               emailRegex: /^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/
          },
          // edtPassword: {
          //      // required: true
          // },
          edtConfirmar_contraseña: {
               // required: true,
               equalTo: "#edtPassword"
          },
          edtTipoUsuario:{
               required: true
          }
       },
       messages: {
          edtNombreUsuario: {
               required: "Por favor ingrese el nombre del usuario",
               regex: "No se permiten caracteres especiales"
          },
          edtApellidoUsuario: {
               required: "Por favor ingrese el apellido del usuario",
               regex: "No se permiten caracteres especiales"
          },
          edtCorreoUsuario: {
           required: "Por favor llene este campo",
           emailRegex: "Ingrese un correo válido"
         },
     //     edtPassword: {
     //       required: "Por favor ingresa una contraseña"
     //     },
         edtConfirmar_contraseña: {
          //  required: "La contraseña debe ser igual a la del campo anterior",
           equalTo: "La contraseña no coincide"
         },
         edtTipoUsuario:{
          required: "Por favor seleccione una opción"
         }
       },
       errorElement: 'span',
          errorPlacement: function (error, element) {
               error.addClass('invalid-feedback');
               element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
               $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
               $(element).removeClass('is-invalid');
          }
     });
   });