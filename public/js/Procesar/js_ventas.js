  var url='ventas';
 
 
 
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var cod_producto=     $('#cod_producto').val();
   var  descripcion=      $('#descripcion').val();
            
                var     precio=          $('#precio').val();
                 var   cantidad=        $('#cantidad').val();

    var formData = {
                    id_cliente:       $('#id_cliente').val(),
                    nombre_cliente :  $('#nombre_cliente').val(), 
                    telefono_cliente: $('#telefono_cliente').val(),
                    direccion_cliente:$('#direccion_cliente').val(),
                    barrio_cliente:   $('#barrio_cliente').val(),
                    ciudad_cliente:   $('#ciudad_cliente').val(),
                    departamento_cliente: $('#departamento_cliente').val(),
                    ruc_cliente:      $('#ruc_cliente').val(),
                    email_cliente:    $('#email_cliente').val(),
                    ubicacion_cliente:$('#ubicacion_cliente').val(),
                    tipo_cliente:     $('#tipo_cliente').val(),
                    nota_cliente:     $('#nota_cliente').val(),
                   
                    fecha_venta:      $('#fecha_entrega').val(),
                    fecha_entrega:    $('#fecha_entrega').val(),
                    horario_venta:    $('#horario_venta').val(), 
                    forma_pago:       $('#forma_pago').val(),
                    factura:          $('#factura').val(),
                    vendedor:         $('#vendedor').val(),
                    factura_nomb:     $('#factura_nomb').val(),
                    factura_dir:      $('#factura_dir').val(),
                    factura_ruc:      $('#factura_ruc').val(),
                    delivery:         $('#delivery').val(),
                    monto:            $('#monto').val(),
                    nota_venta:       $('#nota_venta').val(),
                    descripcion:      $('#descripcion').val(),
                    
                    cod_producto:     $('#cod_producto').val(),
                    id_producto:      $('#id_producto').val(),
                    descripcion:      $('#descripcion').val(),
                    stock:            $('#stock').val(),
                    precio:           $('#precio').val(),
                    cantidad:         $('#cantidad').val(),
                    id_estado :       $('#id_estado').val(),
                    id_usuario :      $('#id_usuario').val(),
                    }

    console.log(formData);
    $.ajax({
        type: "POST",
        url: url +"/add",
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
          console.log(data);
           var cesta = '<tr id="cesta' + cod_producto + '"><td width="15%">' + cod_producto + '</td><td width="25%">' + descripcion + '</td><td width="20%">' + cantidad + '</td><td width="20%">' + precio + '</td><td width="20%">' + cantidad*precio + '</td><div class="btn-group">                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-trash"></i></a><a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a></div></tr>';
               cesta+='<tr><td colspan="5" class="text-right"><h4>Total: 0000000</h4></td><td><button class="btn btn-primary" type="submit" >Guardar</button></td></tr>';
            $('#cesta-list').append(cesta);
            
           
        
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

/*$("#btn-edit").click(function (e) {
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
                    id_estado : $('#id_estado').val(),
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
           // $("#res").html("El Cliente fue  Registrado con Éxito").show();
          //  $("#res").css("display","block");
           // $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
            
            alert("El Cliente fue  Modificado con Éxito");
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
});*/
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
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
    
            $(".clientes").html(data);
        }
    });
});