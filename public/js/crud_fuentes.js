var url = "fuentes";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del fuente
$(document).on('click', '.open_modal', function () {
    var fuente_id = $(this).val();
    $.get(url + '/edit/' + fuente_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#fuente_id').val(data.id);
        $('#nombre').val(data.fuente);
        if (data.status==1){
        $('input:radio[id=status]').prop("checked", true);
        }
        if (data.status==0){
        $('input:radio[id=status2]').prop("checked", true);
        }
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   fuente
$(document).on('click', '.confirm-delete', function () {
    var fuente_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#fuente-id').val(fuente_id);
});


// eliminar el fuente y eliminarlo de la lista
$(document).on('click', '.delete-fuente', function () {

    var fuente_id = $('#fuente-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + fuente_id,
        success: function (data) {
            console.log(data);
            $("#fuente" + fuente_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Fuente Eliminado con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
// crear nuevo fuente
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreFuente').val(),
        status: $('input:radio[name=statusFuente]:checked').val(),
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
            var act='Activo';
            var ina='Inactivo';
            var fuente = '<tr id="fuente' + data.id + '"><td>' + data.fuente + '</td>'+(data.status==1 ? '<td>' + act + '</td>':'<td>' + ina + '</td>');
            fuente += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            fuente += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#fuentes-list').append(fuente);
            $('#frmc').trigger("reset");
            $("#res").html("Fuente Registrada con Exito");
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


////actualiza fuente
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var fuente_id = $('#fuente_id').val();
        var formData = {nombre: $('#nombre').val(), status: $('input:radio[name=status]:checked').val(), }
        var my_url = url;
        my_url += '/mod/'+ fuente_id;
   
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
            var fuente = '<tr id="fuente' + data.id + '"><td>' + data.fuente + '</td>'+(data.status==1 ? '<td>' + act + '</td>': '<td>' + ina + '</td>');
            fuente += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            fuente += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#fuente" + fuente_id).replaceWith(fuente);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Fuente Modificado con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});