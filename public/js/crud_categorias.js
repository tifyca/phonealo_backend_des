var url = "categorias";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del categoria
$(document).on('click', '.open_modal', function () {
    var categoria_id = $(this).val();
    $.get(url + '/edit/' + categoria_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#categoria_id').val(data.id);
        $('#nombre').val(data.categoria);
        $('#tipo').val(data.tipo);
        if (data.status==1){
        $('input:radio[id=status]').prop("checked", true);
        }
        if (data.status==0){
        $('input:radio[id=status2]').prop("checked", true);
        }
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   categoria
$(document).on('click', '.confirm-delete', function () {
    var categoria_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#categoria-id').val(categoria_id);
});


// eliminar el categoria y eliminarlo de la lista
$(document).on('click', '.delete-categoria', function () {

    var categoria_id = $('#categoria-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + categoria_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#categoria" + categoria_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Categoria Eliminado con Éxito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo eliminar la categoría, por que está asociada a una Subcategoria");
            $("#rese").css("display","block");
            $("#rese").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }
    });
});
// crear nuevo categoria
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreCategoria').val(),
        tipo: $('#tipoCategoria').val(),
        status: $('input:radio[name=statusCategoria]:checked').val(),
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
            var act='Activo';
            var ina='Inactivo';
            var categoria = '<tr id="categoria' + data.id + '"><td>' + data.categoria + '</td><td>' + data.tipo + '</td>'+(data.status==1 ? '<td>' + act + '</td>':'<td>' + ina + '</td>');
            categoria += '<td width="10%" class="text-right"><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            categoria += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#categorias-list').append(categoria);
            $('#frmc').trigger("reset");
            $("#res").html("Categoria Registrado con Éxito");
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


////actualiza categoria
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var categoria_id = $('#categoria_id').val();
        var formData = { nombre: $('#nombre').val(),  
                         tipo: $('#tipo').val(), 
                         status: $('input:radio[name=status]:checked').val(), 
                         id_usuario: $('#id_usuario').val(), 
                       }
        var my_url = url;
        my_url += '/mod/'+ categoria_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            var act='Activo';
            var ina='Inactivo';
            var categoria = '<tr id="categoria' + data.id + '"><td>' + data.categoria + '</td><td>' + data.tipo + '</td>'+(data.status==1 ? '<td>' + act + '</td>': '<td>' + ina + '</td>');
            categoria += '<td width="10%" class="text-right"><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            categoria += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#categoria" + categoria_id).replaceWith(categoria);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Categoria Modificado con Éxito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
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