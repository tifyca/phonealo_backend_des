var url = "ciudades";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del ciudad
$(document).on('click', '.open_modal', function () {
    var ciudad_id = $(this).val();
    $.get(url + '/edit/' + ciudad_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#ciudad_id').val(data.id);
        $('#nombre').val(data.ciudad);
        $('select[name=departamento]').val(data.id_departamento);
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   ciudad
$(document).on('click', '.confirm-delete', function () {
    var ciudad_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#ciudad-id').val(ciudad_id);
});


// eliminar el ciudad y eliminarlo de la lista
$(document).on('click', '.delete-ciudad', function () {

    var ciudad_id = $('#ciudad-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + ciudad_id,
        success: function (data) {
            console.log(data);
            $("#ciudades" + ciudad_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Ciudad Eliminada con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
// crear nuevo ciudad
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreCiudad').val(),
        id_dpto:$('.departamento').val(),
        id_usuario: $('#id_usuario').val(),
    }
   
    console.log(formData);
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            var ciudad = '<tr id="ciudades' + data.id + '"><td>' + data.ciudad + '</td>';
            ciudad += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            ciudad += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#ciudades-list').append(ciudad);
            $('#frmc').trigger("reset");
            $("#res").html("Ciudad Registrada con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
       
          error: function (data,estado,error) { 
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


////actualiza ciudad
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var ciudad_id = $('#ciudad_id').val();
        var formData = {nombre: $('#nombre').val(), id_usuario: $('#id_usuario').val(), id_dpto:$('.departamento').val(), }
        var my_url = url;
        my_url += '/mod/'+ ciudad_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data.ciudad);
             var ciudad = '<tr id="ciudades' + data.id + '"><td>' + data.ciudad + '</td>';
            ciudad += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            ciudad += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#ciudades" + ciudad_id).replaceWith(ciudad);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Ciudad Modificada con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});