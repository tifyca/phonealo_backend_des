var url = "cargos";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del cargo
$(document).on('click', '.open_modal', function () {
    var cargo_id = $(this).val();
    $.get(url + '/edit/' + cargo_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#cargo_id').val(data.id);
        $('#nombre').val(data.cargo);
        if (data.status==1){
        $('input:radio[id=status]').prop("checked", true);
        }
        if (data.status==0){
        $('input:radio[id=status2]').prop("checked", true);
        }
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   cargo
$(document).on('click', '.confirm-delete', function () {
    var cargo_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#cargo-id').val(cargo_id);
});


// eliminar el cargo y eliminarlo de la lista
$(document).on('click', '.delete-cargo', function () {

    var cargo_id = $('#cargo-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + cargo_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#cargo" + cargo_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Cargo Eliminado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo Eliminar el Cargo, por que está Asociada a un Empleado");
            $("#rese, #res-content, #res-content").css("display","block");
            $("#rese, #res-content, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }
    });
});
// crear nuevo cargo
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreCargo').val(),
        status: $('input:radio[name=statusCargo]:checked').val(),
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
            var cargo = '<tr id="cargo' + data.id + '"><td width="45%">' + data.cargo + '</td>'+(data.status==1 ? '<td width="45%">' + act + '</td>':'<td width="45%">' + ina + '</td>');
            cargo += '<td width="10%" class="text-right"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            cargo += ' <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#cargos-list').append(cargo);
            $('#frmc').trigger("reset");
            $("#res").html("Cargo Registrado con Éxito");
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


////actualiza cargo
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var cargo_id = $('#cargo_id').val();
        var formData = { nombre: $('#nombre').val(), 
                         status: $('input:radio[name=status]:checked').val(), 
                         id_usuario: $('#id_usuario').val(), 
                        }
        var my_url = url;
        my_url += '/mod/'+ cargo_id;
   
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
            var cargo = '<tr id="cargo' + data.id + '"><td width="45%" >' + data.cargo + '</td>'+(data.status==1 ? '<td width="45%">' + act + '</td>': '<td width="45%">' + ina + '</td>');
            cargo += '<td width="10%" class="text-right"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            cargo += ' <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#cargo" + cargo_id).replaceWith(cargo);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Cargo Modificado con Éxito");
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
    var route ="cargos";
    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".cargos").html(data);
        }
    });
});

$(document).on('click','.save',function(e){
    e.preventDefault();

   var route ="cargos";
    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".cargos").html(data);
        }
    });
});

  