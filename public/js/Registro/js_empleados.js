$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
                    nombre_empleado :  $('#nombre_empleado').val(), 
                    ci_empleado:       $('#ci_empleado').val(),
                    telefono_empleado: $('#telefono_empleado').val(),
                    email_empleado:    $('#email_empleado').val(),
                    direccion_empleado:$('#direccion_empleado').val(),
                    cargo_empleado:    $('#cargo_empleado').val(),
                    ref_empleado:      $('#referencia_empleado').val(),
                    id_estado :        $('#id_estado').val(),
                    id_usuario :       $('#id_usuario').val(),
                    }

    console.log(formData);
    $.ajax({
        type: "POST",
        url: "create",
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
           // $("#res").html("El Cliente fue  Registrado con Éxito").show();
          //  $("#res").css("display","block");
           // $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
            
           // alert("El Empleado fue  Registrado con Éxito");
           // location.href="/registro/empleados";
        
       },
       
          error: function (data,estado,error) { 
            console.log(error);
            var errorsHtml = '';
           var error = jQuery.parseJSON(data.responseText);
             errorsHtml +="<ul style='list-style:none;'>";
             for(var k in error.message){ 
                if(error.message.hasOwnProperty(k)){ 
                    error.message[k].forEach(function(val){

                       errorsHtml +="<li class='text-danger'>" + val +"</li>";
                       
                        
                        $("#rese").html(errorsHtml);
                        $("#rese, #res-content").css("display","block");
                        $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                     
                      }); 
                }
            }
          errorsHtml +="</ul>"; 
        },
    });
});

$("#btn-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
     var empleado_id =$('#empleado_id').val();
    var formData = {
                    nombre_empleado :  $('#nombre_empleado').val(), 
                    ci_empleado:       $('#ci_empleado').val(),
                    telefono_empleado: $('#telefono_empleado').val(),
                    cargo_empleado:    $('#cargo_empleado').val(),
                    email_empleado:    $('#email_empleado').val(),
                    direccion_empleado:$('#direccion_empleado').val(),
                    ref_empleado:      $('#referencia_empleado').val(),
                    id_estado :        $('input:radio[name=status]:checked').val(),
                    id_usuario :       $('#id_usuario').val(),
                    }

    console.log(formData);
 
   var  my_url = '../mod/'+ empleado_id;
    $.ajax({
        type: "PUT",
        url:  my_url, 
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
           // $("#res").html("El Cliente fue  Registrado con Éxito").show();
          //  $("#res").css("display","block");
           // $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
            
            alert("El Empleado fue  Modificado con Éxito");
            location.href="/registro/empleados";
        
       },
       
          error: function (data,estado,error) { 
            console.log(error);
          var errorsHtml = '';
           var error = jQuery.parseJSON(data.responseText);
             errorsHtml +="<ul style='list-style:none;'>";
             for(var k in error.message){ 
                if(error.message.hasOwnProperty(k)){ 
                    error.message[k].forEach(function(val){

                       errorsHtml +="<li class='text-danger'>" + val +"</li>";
                       
                        
                        $("#rese").html(errorsHtml);
                        $("#rese, #res-content").css("display","block");
                        $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                     
                      }); 
                }
            }
          errorsHtml +="</ul>"; 
        },
    });
});


$(document).on('click', '.confirm-delete', function () {
    var id_empleado = $(this).val();
    $('#confirm-delete').modal('show');
    $('#empleado-id').val(id_empleado);
});


// eliminar el empleado y eliminarlo de la lista
$(document).on('click', '.delete-empleado', function () {

    var id_empleado = $('#empleado-id').val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    var  my_url = 'empleados/'+ id_empleado;
    $.ajax({
        type: "DELETE",
        url: my_url,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#empleado" + id_empleado).remove();
            $('#confirm-delete').modal('hide');
            $("#res, #res-content").html("Empleado Eliminado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 39];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function soloNumeros(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46) || (keynum == 45) || (keynum == 44))
return true;
return /\d/.test(String.fromCharCode(keynum));
}




$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
console.log(page);
    var route ="empleados";
    $.ajax({
        url: route,
        data: {page: page,
              empleado: $('#empleado').val(),
               email: $('#email').val(),
               status: $('#status').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
    
            $(".empleados").html(data);
        }
    });
});

$(document).on('click','#btnBuscar',function(e){
   

    var route ="empleados";
    $.ajax({
        url: route,
        data: {empleado: $('#empleado').val(),
               email: $('#email').val(),
               status: $('#status').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
          
            $("#divempleados").html(data);

        }
    });
});