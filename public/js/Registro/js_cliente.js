$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
                    nombre_cliente : $('#nombre_cliente').val(), 
                    telefono_cliente: $('#telefono_cliente').val(),
                    direccion_cliente: $('#direccion_cliente').val(),
                    barrio_cliente: $('#barrio_cliente').val(),
                    ciudad_cliente: $('#ciudad_cliente').val(),
                    departamento_cliente: $('#departamento_cliente').val(),
                    ruc_cliente:  $('#ruc_cliente').val(),
                    email_cliente: $('#email_cliente').val(),
                    ubicacion_cliente: $('#ubicacion_cliente').val(),
                    tipo_cliente: $('#tipo_cliente').val(),
                    nota_cliente: $('#nota_cliente').val(),
                    id_estado : $('#id_estado').val(),
                    id_usuario : $('#id_usuario').val(),
                    }

    console.log(formData);
    $.ajax({
        type: "POST",
        url: "create",
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
 
            $("#res").html(data.message);
            $("#res, #res-content").css("display","block");
        
            location.href="/registro/clientes";
         
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
     var cliente_id =$('#cliente_id').val();
    var formData = {
                    nombre_cliente : $('#nombre_cliente').val(), 
                    telefono_cliente: $('#telefono_cliente').val(),
                    direccion_cliente: $('#direccion_cliente').val(),
                    barrio_cliente: $('#barrio_cliente').val(),
                    ciudad_cliente: $('#ciudad_cliente').val(),
                    departamento_cliente: $('#departamento_cliente').val(),
                    ruc_cliente:  $('#ruc_cliente').val(),
                    email_cliente: $('#email_cliente').val(),
                    ubicacion_cliente: $('#ubicacion_cliente').val(),
                    tipo_cliente: $('#tipo_cliente').val(),
                    nota_cliente: $('#nota_cliente').val(),
                    id_estado :        $('input:radio[name=status]:checked').val(),
                    id_usuario : $('#id_usuario').val(),
                    }

    console.log(formData);
   
       var  my_url = '../mod/'+ cliente_id;
    $.ajax({
        type: "PUT",
        url:  my_url, 
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
         
            $("#res").html(data.message);
            $("#res, #res-content").css("display","block");
            location.href="/registro/clientes";
        
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
    var route ="clientes";
    $.ajax({
        url: route,
        data: {page: page,
              cliente: $('#cliente').val(),
               email: $('#email').val(),
               status:$('#status').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
    
            $(".clientes").html(data);
        }
    });
});

$(document).on('click','#btnBuscar',function(e){
   

    var route ="clientes";
    $.ajax({
        url: route,
        data: {cliente: $('#cliente').val(),
               email: $('#email').val(),
               status:$('#status').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
          
            $("#divclientes").html(data);

        }
    });
});