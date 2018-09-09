$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
                    nombre_proveedor :   $('#nombre_proveedor').val(), 
                    email_proveedor:     $('#email_proveedor').val(),
                    direccion_proveedor: $('#direccion_proveedor').val(),
                    telefono_proveedor:  $('#telefono_proveedor').val(),                  
                    ruc_proveedor:       $('#ruc_proveedor').val(),
                    pais_proveedor:      $('#pais_proveedor').val(),
                    id_estado:           $('#id_estado').val(),
                    id_usuario:          $('#id_usuario').val(),
                    }

    console.log(formData);
    $.ajax({
        type: "POST",
        url: "create",
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {

            alert("El Proveedor fue  Registrado con Éxito");
            location.href="/registro/proveedores";
        
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
                       
                        $("#rese").html(errorsHtml).show().fadeOut(4000);
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
     var proveedor_id =$('#proveedor_id').val();
    var formData = {
                    nombre_proveedor :   $('#nombre_proveedor').val(), 
                    email_proveedor:     $('#email_proveedor').val(),
                    direccion_proveedor: $('#direccion_proveedor').val(),
                    telefono_proveedor:  $('#telefono_proveedor').val(),                  
                    ruc_proveedor:       $('#ruc_proveedor').val(),
                    pais_proveedor:      $('#pais_proveedor').val(),
                    id_estado:           $('#id_estado').val(),
                    id_usuario:          $('#id_usuario').val(),
                    }

    console.log(formData);
   
       var  my_url = '../mod/'+ proveedor_id;
    $.ajax({
        type: "PUT",
        url:  my_url, 
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
           
            alert("El Proveedor fue  Modificado con Éxito");
            location.href="/registro/proveedores";
        
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
                       
                        $("#rese").html(errorsHtml).show().fadeOut(4000);
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
    var route ="proveedores";
    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
    
            $(".proveedores").html(data);
        }
    });
});