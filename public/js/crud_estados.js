var url = "estados";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del estado
$(document).on('click', '.open_modal', function () {
    var estado_id = $(this).val();
    $.get(url + '/edit/' + estado_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#estado_id').val(data.id);
        $('#nombre').val(data.estado);
        
        $('#myModal').modal('show');
    });
    
});




////actualiza estado
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var estado_id = $('#estado_id').val();
        var formData = {nombre: $('#nombre').val(),  id_usuario: $('#id_usuario').val(), }
        var my_url = url;
        my_url += '/mod/'+ estado_id;
   
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
            var estado = '<tr id="estado' + data.id + '"><td>' + data.estado + '</td>';
            estado += '<td width="10%" class="text-right"><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button></div></td></tr>';
            $("#estado" + estado_id).replaceWith(estado);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("estado Modificado con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});