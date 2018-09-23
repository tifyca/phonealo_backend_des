  var url='ventas';
 
 
 function add_cesta(){
   $(document).ready(function(){

    var cod_producto= $('#cod_producto').val();
    var  descripcion= $('#descripcion').val();
    var     precio  = $('#precio').val();
    var   cantidad  = $('#cantidad').val();
    var     stock  = $('#stock').val();

    var dispo=stock-cantidad;
    console.log(dispo);

      if(dispo>=0){
          
          var importe= cantidad*precio;
          var cesta  = '<tr><td  width="15%">' + cod_producto + '</td>'+
                            '<td width="30%">' + descripcion + '</td>'+
                            '<td width="15%">' + cantidad + '</td>' +
                            '<td width="20%">' + precio + '</td>'+
                            '<td width="20%">' + importe+ '</td>'+
                            '<td width="15%" class="text-center"><div class="btn-group">'+
                                 '<a class="btn btn-primary" href="#">'+
                                 '<i class="m-0 fa fa-lg fa-trash"></i></a>'+
                                 '<a class="btn btn-primary" href="">'+
                                 '<i class="m-0 fa fa-lg fa-info"></i></a></div>'+
                            '</td>'+
                          '</tr>';
           

          
            $('#cesta-list > tbody').append(cesta);
            resumen();
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
            var formData = {
                   
                    
                    cod_producto:     $('#cod_producto').val(),
                    id_producto:      $('#id_producto').val(),
                    descripcion:      $('#descripcion').val(),
                    stock:            $('#stock').val(),
                    precio:           $('#precio').val(),
                    cantidad:         $('#cantidad').val(),
                    disponible:       dispo,
                   
                    }

           $.ajax({
              type: "POST",
              url:  'ventas'+'/'+'add', 
              data: formData,
              dataType: 'json',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              success: function (data) {
     
            $('#cod_producto').val("");
            $('#descripcion').val("");
            $('#precio').val("");
            $('#cantidad').val("");
            $('#stock').val("");
            $('#descripcion').focus();
          
        
          },
       
        
          });
      }else{

        var importe= cantidad*precio;
          var cesta  = '<tr class="table-danger"><td  width="15%">' + cod_producto + '</td>'+
                            '<td width="30%">' + descripcion + '</td>'+
                            '<td width="15%">' + cantidad + '</td>' +
                            '<td width="20%">' + precio + '</td>'+
                            '<td width="20%">' + importe+ '</td>'+
                            '<td width="15%" class="text-center"><div class="btn-group">'+
                                 '<a class="btn btn-primary" href="#">'+
                                 '<i class="m-0 fa fa-lg fa-trash"></i></a>'+
                                 '<a class="btn btn-primary" href="">'+
                                 '<i class="m-0 fa fa-lg fa-info"></i></a></div>'+
                            '</td>'+
                          '</tr>';
           

          
            $('#cesta-list > tbody').append(cesta);
             $("#faltante, #fal-content").html(' Se agregó un producto faltante');
             $('#fal-content').css("display","block");
             $('#spacio').css("display","none");
            
            resumen();
            var dispo=0;
            var formData = {
                   
                    
                    cod_producto:     $('#cod_producto').val(),
                    id_producto:      $('#id_producto').val(),
                    descripcion:      $('#descripcion').val(),
                    stock:            $('#stock').val(),
                    precio:           $('#precio').val(),
                    cantidad:         $('#cantidad').val(),
                    disponible:      dispo 
                   
                    }

            $.ajax({
              type: "POST",
              url:  'add', 
              data: formData,
              dataType: 'json',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              success: function (data) {
     
            $('#cod_producto').val("");
            $('#descripcion').val("");
            $('#precio').val("");
            $('#cantidad').val("");
            $('#stock').val("");
            $('#descripcion').focus();




      }     
            
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