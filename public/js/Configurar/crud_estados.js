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
            var estado = '<tr id="estado' + data.id + '"><td width="90%">' + data.estado + '</td>';
            estado += '<td width="10%" class="text-center"><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button></div></td></tr>';
            $("#estado" + estado_id).replaceWith(estado);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Estado Modificado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
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
    var route ="estados";
    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".estados").html(data);
        }
    });
});