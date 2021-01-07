// Validaciones del formulario y los mensajes respectivos utilizando la libreria jquery-validator
$(function() {
    $("form[name='formContacto']").validate({
      rules: {
        nombre: "required",
        apellido: "required",
        email: {
          required: true,
          email: true
        },
        mensaje: {
          required: true,
          minlength: 5
        }
      },
      messages: {
        nombre: "Por favor, introduzca su nombre",
        apellido: "Por favor, introduzca su apellido",
        email: "Por favor, introduce una dirección de correo electrónico válida",
        mensaje: {
          required: "Por favor proporcione un mensaje",
          minlength: "El mensaje debe tener al menos 5 caracteres."
        }
      },
  
      submitHandler: function(form) {
        //form.submit();
      }
    });
  });


  $(document).ready(function(){ 
   
    /* Metodo al hacer click en enviar y serializando el formulario */
    $('#enviar').click(function() {
        var isValid = true;
        $('.form-control').each(function(){
            isValid &= validateInput($(this));
            console.log('Valido:', isValid);
        });
        if (isValid)
        {
            var data = $('#formContacto').serialize();
            $.ajax({
               url: 'enviar.php',
               type: 'POST',
               data: data,
               success: (respuesta) => { 
                respuesta = JSON.parse(respuesta);
                if(respuesta.estado === 'OK'){
                    $('#nombre').val('');
                    $('#apellido').val('');
                    $('#email').val('');
                    $('#mensaje').val('');
                    $('.exito').show();
                }
            },
            error: (e) => {
                console.log(e);
                $('.falla').show();
            }
            });
        }
      });

      /* Metodo el submitiar al formulario y sin serializar el formulario */
    /*$('#formContacto').submit(function(e) {
        e.preventDefault();
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let email = $('#email').val();
        let mensaje = $('#mensaje').val();

        // Pegada al php
        $.ajax({
            url: 'enviar.php',
            type: 'POST',
            dataType: 'JSON',
            data: {nombre, apellido, email, mensaje},
            success: (respuesta) => { //result,status,xhr
                //console.log('result', result);
                //console.log('status', status);
                //console.log('xhr', xhr);
                console.log('respuesta', respuesta);
                if(respuesta.estado === 'OK'){
                    $('#nombre').val('');
                    $('#apellido').val('');
                    $('#email').val('');
                    $('#mensaje').val('');
                    $('.exito').show();
                }
            },
            error: (e) => {
                console.log(e);
                $('.falla').show();
            }
        })
    });*/
  });