$(document).ready(function () {
     
     //CORREO ELECTRONICO
     $.validator.addMethod(  "emailRegex", function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
          },
          "Por favor ingrese un correo válido"
     );
     
     $('#loginFormulario').validate({
       rules: {
          correo: {
               required: true,
               emailRegex: /^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/
          },
          password: {
               required: true
          },
       },
       messages: {
         correo: {
           required: "Por favor llene este campo",
           emailRegex: "Ingrese un correo válido"
         },
         password: {
           required: "Por favor ingresa una contraseña"
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