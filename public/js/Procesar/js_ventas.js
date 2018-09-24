var url='ventas';
 
 
 function add_cesta(){
   $(document).ready(function(){

    var id_cliente  = $('#id_cliente').val();
    var id_usuario  = $('#id_usuario').val();
    var id_producto = $('#id_producto').val();
    var cod_producto= $('#cod_producto').val();
    var  descripcion= $('#descripcion').val();
    var     precio  = $('#precio').val();
    var   cantidad  = $('#cantidad').val();
    var     stock   = $('#stock').val();

   // if(stock==0){var dispo=stock;}else{var dispo=stock-cantidad;}
   var dispo=stock-cantidad;
  
      if(dispo>=0){

          var espera =0;  
          var importe= cantidad*precio;
          
            $.ajaxSetup({
             headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
             });
            var formData = {
                    id_usuario:   id_usuario,
                    id_cliente:       id_cliente,
                    cod_producto:     cod_producto,
                    id_producto:      id_producto,
                    descripcion:      descripcion,
                    stock:            stock,
                    precio:           precio,
                    cantidad:         cantidad,
                    disponible:       dispo,
                    espera:           espera
                   }

           $.ajax({
              type: "POST",
              url:  'ventas'+'/'+'add', 
              data: formData,
              dataType: 'json',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              success: function (data) {

                var cesta  = '<tr><td  width="15%" id="d-cod_producto">' + cod_producto + '</td>'+
                            '<td width="30%" id="d-descripcion">' + descripcion + '</td>'+
                            '<td width="15%" id="d-cantidad" class="text-center">' + cantidad + '</td>' +
                            '<td width="20%" id="d-precio" class="text-center">' + precio + '</td>'+
                            '<td width="20%" id="d-importe" class="text-center">' + importe+ '</td>'+
                            '<td width="15%" class="text-center"><div class="btn-group">'+
                                 '<button ata-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary delete" value="'+id_producto+'" >'+
                                 '<i class="m-0 fa fa-lg fa-trash"></i></button>'+
                                 '<button data-toggle="tooltip" data-placement="top" title="Detalle" class="btn btn-primary open_modal" value="'+id_producto+'">'+
                                 '<i class="m-0 fa fa-lg fa-info"></i></button></div>'+
                            '</td>'+
                          '</tr>';
                 
            $('#cesta-list > tbody').append(cesta);
            $('#stock_original').val(stock);
            resumen();
            
     
            $('#cod_producto').val("");
            $('#descripcion').val("");
            $('#precio').val("");
            $('#cantidad').val("");
            $('#stock').val("");
            $('#descripcion').focus();
          
        
          },
       
          error: function (data,estado,error) { 
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
      }else{

          var espera=1;
          var importe= cantidad*precio;
          
           $.ajaxSetup({
             headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
             });
             var formData = {
                    id_usuario:       id_usuario,
                    id_cliente:       id_cliente,
                    cod_producto:     cod_producto,
                    id_producto:      id_producto,
                    descripcion:      descripcion,
                    stock:            stock,
                    precio:           precio,
                    cantidad:         cantidad,
                    disponible:       stock,
                    espera:           espera
                    }

             $.ajax({
                type: "POST",
                url:  'ventas'+'/'+'add', 
                data: formData,
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {

                  var cesta  = '<tr class="table-danger"><td  width="15%" id="d-cod_producto">' + cod_producto + '</td>'+
                            '<td width="30%" id="d-descripcion">' + descripcion + '</td>'+
                            '<td width="15%" id="d-cantidad" class="text-center">' + cantidad + '</td>' +
                            '<td width="20%" id="d-precio" class="text-center">' + precio + '</td>'+
                            '<td width="20%" id="d-importe" class="text-center">' + importe+ '</td>'+
                            '<td width="15%" class="text-center"><div class="btn-group">'+
                                 '<button ata-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary delete" value="'+id_producto+'" >'+
                                 '<i class="m-0 fa fa-lg fa-trash"></i></a>'+
                                 '<button data-toggle="tooltip" data-placement="top" title="Detalle" class="btn btn-primary open_modal" value="'+id_producto+'" >'+
                                 '<i class="m-0 fa fa-lg fa-info"></i></button></div>'+
                            '</td>'+
                          '</tr>';
           
             $('#cesta-list > tbody').append(cesta);
             $("#faltante, #fal-content").html(' Se agregó un producto faltante');
             $('#fal-content').css("display","block");
             $('#spacio').css("display","none");
            
             resumen();
     
                  $('#cod_producto').val("");
                  $('#descripcion').val("");
                  $('#precio').val("");
                  $('#cantidad').val("");
                  $('#stock').val("");
                  $('#descripcion').focus();
              },    
          error: function (data,estado,error) { 
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
            
          })  
       }     
        
     });
  }

function resumen(){
  $(document).ready(function(){
            
          var monto=0;
            $('#cesta-list > tbody > tr').each(function(){
            monto+= parseFloat( $(this).find('td').eq(4).html());
            });
                   
            $("#total_venta").val(monto);
            $("#total").html('Total Gs.:'+ monto);
            /*if(articulos>0){
              $("#btn-procesa").prop('disabled', false);
              $("#btn-cancela").prop('disabled', false);
            }else{
              $("#btn-procesa").prop('disabled', true);
              $("#btn-cancela").prop('disabled', true);
            }*/
            })
          }


$(document).on('click', '.delete', function (e) {
    e.preventDefault();
      $(this).closest('tr').remove();
      resumen();
     var id_producto = $(this).val();
           $.ajaxSetup({
             headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
             });
             $.get('elimanarProdCesta/' + id_producto, function(data){
console.log(data);
              
                  
               if(data==0){
                 $('#fal-content').css("display","none");
                 $('#spacio').css("display","block");
               }

            })
                  
            
         

 
    
});   

$("#btn-save").click(function (e) {
    $('#cesta-list > tbody > tr').each(function(){
      descripcion  = $(this).find('td').eq(1).html();
      cod_producto = $(this).find('td').eq(0).html();
      cantidad     = $(this).find('td').eq(2).html();
      precio       = $(this).find('td').eq(3).html();
      importe      = $(this).find('td').eq(4).html();
         
            });

   
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
     //var cliente_id =$('#cliente_id').val();
    var formData = {
                    id_cliente     : $('#id_cliente').val(),
                    nombre_cliente : $('#nombre_cliente').val(), 
                    telefono_cliente: $('#telefono_cliente').val(),
                    direccion_cliente:$('#direccion_cliente').val(),
                    barrio_cliente : $('#barrio_cliente').val(),
                    ciudad_cliente : $('#ciudad_cliente').val(),
                    departamento_cliente: $('#departamento_cliente').val(),
                    ruc_cliente    : $('#ruc_cliente').val(),
                    email_cliente  : $('#email_cliente').val(),
                    ubicacion_cliente: $('#ubicacion_cliente').val(),
                    tipo_cliente   : $('#tipo_cliente').val(),
                    nota_cliente   : $('#nota_cliente').val(),
                    id_estado      : 1,
                    id_usuario     : $('#id_usuario').val(),
                    fecha_venta    : $('#fecha_venta').val(),
                    fecha_entrega  : $('#fecha_entrega').val(),
                    horario_venta  : $('#horario_venta').val(),
                    forma_pago     : $('#forma_pago').val(),
                    factura        : $('#factura').val(),
                    vendedor       : $('#vendedor').val(),
                    factura_nomb   : $('#factura_nomb').val(),
                    factura_dir    : $('#factura_dir').val(),
                    factura_ruc    : $('#factura_ruc').val(),
                    delivery       : $('#delivery').val(),
                    monto          : $('#monto').val(),
                    nota_venta     : $('#nota_venta').val(),
                    descripcion    :  descripcion,
                    id_producto    : $('#id_producto').val(),
                    cod_producto   : cod_producto,
                    cantidad       : cantidad,
                    precio         : precio,
                    importe        : importe,
                    total          : $('#total').val()
                    }

    console.log(formData);
   
     
    $.ajax({
        type: "POST",
        url: "ventas/create",
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
           $("#res").html(data.message);
            $("#res, #res-content").css("display","block");
        
            location.href="/procesar/ventas";
        
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
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
    
            $(".clientes").html(data);
        }
    });
});