var url = "horas";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del hora
$(document).on('click', '.open_modal', function () {
    var hora_id = $(this).val();
    $.get(url + '/edit/' + hora_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#hora_id').val(data.id);
        $('#horario').val(data.horario);
        $('select[name=statusventa]').val(data.status_v);
        if (data.status==1){
        $('input:radio[id=status]').prop("checked", true);
        }
        if (data.status==0){
        $('input:radio[id=status2]').prop("checked", true);
        }
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   hora
$(document).on('click', '.confirm-delete', function () {
    var hora_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#hora-id').val(hora_id);
});


// eliminar el hora y eliminarlo de la lista
$(document).on('click', '.delete-hora', function () {

    var hora_id = $('#hora-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + hora_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#hora" + hora_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("La Hora de Entrega se Eliminó con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo Eliminar la Hora de Entrega, por que está Asociada a una Venta");
            $("#rese, #res-content, #res-content").css("display","block");
            $("#rese, #res-content, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }
    });
});
// crear nuevo hora
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#horaVenta').val(),
        status: $('input:radio[name=statusHora]:checked').val(),
        status_v: $('#statusVenta').val(),
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
            var esp='Espera';
            var act='Activo';
            var ina='Inactivo';
            var hora = '<tr id="hora' + data.id + '"><td width="30%">' + data.horario + '</td>'+(data.status_v==1 ? '<td width="25%">' + act + '</td>':'<td width="25%">' + esp + '</td>')+(data.status==1 ? '<td width="25%">' + act + '</td>':'<td width="25%">' + ina + '</td>');
            hora += '<td width="15%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            hora += ' <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#horas-list').append(hora);
            $('#frmc').trigger("reset");
            $("#res").html("La Hora de Entrega se Registro con Éxito");
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


////actualiza hora
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var hora_id = $('#hora_id').val();
        var formData = { nombre: $('#horario').val(),
                         status: $('input:radio[name=status]:checked').val(),
                         status_v: $('#statusventa').val(),
                         id_usuario: $('#id_usuario').val(),
                                        }
        var my_url = url;
        my_url += '/mod/'+ hora_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data.status);
            var esp='Espera';
            var act='Activo';
            var ina='Inactivo';
            var hora = '<tr id="hora' + data.id + '"><td width="30%">' + data.horario + '</td>'+(data.status_v==1 ? '<td width="25%">' + act + '</td>':'<td width="25%">' + esp + '</td>')+(data.status==1 ? '<td width="25%">' + act + '</td>':'<td width="25%">' + ina + '</td>');
            hora += '<td width="15%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            hora += ' <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
           $("#hora" + hora_id).replaceWith(hora);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("La Hora de Entrega se  Modifico con Éxito");
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
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789";
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
    var route ="horas";
    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".horas").html(data);
        }
    });
});

$(document).on('click','.save',function(e){
    e.preventDefault();

    var route ="horas";
    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".horas").html(data);
        }
    });
});

  