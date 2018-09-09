var url = "subcategorias";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del categoria
$(document).on('click', '.open_modal', function () {
    var subcategoria_id = $(this).val();

    $.get(url + '/edit/' + subcategoria_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#subcategoria_id').val(data.id);
        $('#nombre').val(data.sub_categoria);
        $('select[name=cat]').val(data.id_categoria);
        if (data.status==1){
        $('input:radio[id=status]').prop("checked", true);
        }
        if (data.status==0){
        $('input:radio[id=status2]').prop("checked", true);
        }
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   subcategoria
$(document).on('click', '.confirm-delete', function () {
    var subcategoria_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#subcategoria-id').val(subcategoria_id);
});


// eliminar el subcategoria y eliminarlo de la lista
$(document).on('click', '.delete-subcategoria', function () {

    var subcategoria_id = $('#subcategoria-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + subcategoria_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#subcategoria" + subcategoria_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Subcategoría Eliminada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
// crear nuevo subcategoria
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreSubcategoria').val(),
        categoria: $('#categoria').val(),
        status: $('input:radio[name=statusSubcategoria]:checked').val(),
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
           // console.log(data);
            var cat=data.id_categoria;

            $.get(url + '/cat/' + cat, function(cate){
       
            var act='Activo';
            var ina='Inactivo';
            var subcategoria = '<tr id="subcategoria' + data.id + '"><td width="30%">' + data.sub_categoria + '</td><td width="30%">' + cate.categoria + '</td>'+(data.status==1 ? '<td width="25%">' + act + '</td>':'<td width="25%">' + ina + '</td>');
            subcategoria += '<td width="15%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            subcategoria += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#subcategorias-list').append(subcategoria);
            $('#frmc').trigger("reset");
            $("#res").html("Subcategoría Registrada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

         });
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


////actualiza subcategoria
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var subcategoria_id = $('#subcategoria_id').val();
        var formData = { nombre: $('#nombre').val(),  
                         categoria: $('#cat').val(), 
                         status: $('input:radio[name=status]:checked').val(), 
                         id_usuario: $('#id_usuario').val(),
                       }
        var my_url = url;
        my_url += '/mod/'+ subcategoria_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {

            var cat=data.id_categoria;

            $.get(url + '/cat/' + cat, function(cate){
       
            var act='Activo';
            var ina='Inactivo';
                 var subcategoria = '<tr id="subcategoria' + data.id + '"><td width="30%">' + data.sub_categoria + '</td><td width="30%">' + cate.categoria + '</td>'+(data.status==1 ? '<td width="25%">' + act + '</td>':'<td width="25%">' + ina + '</td>');
            subcategoria += '<td width="15%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            subcategoria += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#subcategoria" + subcategoria_id).replaceWith(subcategoria);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Subcategoría Modificada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

         });
        },
       error: function (data,estado,error) { 
             var errorsHtml = '';
           var error = jQuery.parseJSON(data.responseText);
            var info = $('#rese');
             for(var k in error.message){ 
                if(error.message.hasOwnProperty(k)){ 
                    error.message[k].forEach(function(val){

                        errorsHtml += val;
                        $("#rese").text(errorsHtml).show().fadeOut(4000);
                         }); 
                }
            }
        },
    });
});

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "áéíóúabcdefghijklmnñopqrstuvwxyz";
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
    var route ="subcategorias";
    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".subcategorias").html(data);
        }
    });
});