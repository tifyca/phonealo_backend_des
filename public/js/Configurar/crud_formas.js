var url = "formas";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del forma
$(document).on('click', '.open_modal', function () {
    var forma_id = $(this).val();
    $.get(url + '/edit/' + forma_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#forma_id').val(data.id);
        $('#nombre').val(data.forma_pago);
        if (data.status==1){
        $('input:radio[id=status]').prop("checked", true);
        }
        if (data.status==0){
        $('input:radio[id=status2]').prop("checked", true);
        }
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   forma
$(document).on('click', '.confirm-delete', function () {
    var forma_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#forma-id').val(forma_id);
});


// eliminar el forma y eliminarlo de la lista
$(document).on('click', '.delete-forma', function () {

    var forma_id = $('#forma-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + forma_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#forma" + forma_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("La Forma de Pago Fue Eliminada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo Eliminar la Forma de Pago, por que está Asociada a Ventas");
            $("#rese, #res-content, #res-content").css("display","block");
            $("#rese, #res-content, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }
    });
});
// crear nuevo forma
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreforma').val(),
        status: $('input:radio[name=statusforma]:checked').val(),
        id_usuario: $('#id_usuario').val(),

    }
    
    console.log(formData);
    $.ajax({
        type: "POST",
        url: url + '/create',
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            var act='Activo';
            var ina='Inactivo';
            var forma = '<tr id="forma' + data.id + '"><td width="45%">' + data.forma_pago + '</td>'+(data.status==1 ? '<td width="45%">' + act + '</td>':'<td width="45%">' + ina + '</td>');
            forma += '<td width="10%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            forma += ' <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#formas-list').append(forma);
            $('#frmc').trigger("reset");
            $("#res").html("La Forma de Pago Fue Registrada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
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
});


////actualiza forma
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var forma_id = $('#forma_id').val();
        var formData = { nombre: $('#nombre').val(), 
                         status: $('input:radio[name=status]:checked').val(), 
                         id_usuario: $('#id_usuario').val(), 
                        }
        var my_url = url;
        my_url += '/mod/'+ forma_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data.status);
            var act='Activo';
            var ina='Inactivo';
            var forma = '<tr id="forma' + data.id + '"><td width="45%" >' + data.forma_pago + '</td>'+(data.status==1 ? '<td width="45%">' + act + '</td>': '<td width="45%">' + ina + '</td>');
            forma += '<td width="10%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            forma += ' <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#forma" + forma_id).replaceWith(forma);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("La Forma de Pago Fue Modificada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data,estado,error) { 
             var errorsHtml = '';
           var error = jQuery.parseJSON(data.responseText);
             errorsHtml +="<ul style='list-style:none;'>";
             for(var k in error.message){ 
                if(error.message.hasOwnProperty(k)){ 
                    error.message[k].forEach(function(val){

                       errorsHtml +="<li class='text-danger'>" + val +"</li>";
                       
                        
                        $("#remodal").html(errorsHtml);
                        $("#remodal").css("display","block");
                        $("#remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                    
                         }); 
                }
            }
          errorsHtml +="</ul>"; 
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
$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
//console.log(page);
    var route ="formas";
    $.ajax({
        url: route,
        data: {page: page, formas: $('#buscarformas').val(), status: $('#selectstatus').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".formas").html(data);
        }
    });
});

$(document).on('click','#btnBuscar',function(e){
   

    var route ="formas";
    $.ajax({
        url: route,
        data: {formas: $('#buscarformas').val(), status: $('#selectstatus').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
          
            $("#divformas").html(data);

        }
    });
});

$(document).on('click','.save',function(e){
    e.preventDefault();

   var route ="formas";
    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".formas").html(data);
        }
    });
});

  