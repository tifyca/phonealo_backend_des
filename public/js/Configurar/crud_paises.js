var url = "paises";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del pais
$(document).on('click', '.open_modal', function () {
    var pais_id = $(this).val();
    $.get(url + '/edit/' + pais_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#pais_id').val(data.id);
        $('#nombre').val(data.nombre);
        
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   pais
$(document).on('click', '.confirm-delete', function () {
    var pais_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#pais-id').val(pais_id);
});


// eliminar el pais y eliminarlo de la lista
$(document).on('click', '.delete-pais', function () {

    var pais_id = $('#pais-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + pais_id,
        success: function (data) {
            console.log(data);
            $("#paises" + pais_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Pais Eliminado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
// crear nuevo pais
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombrePais').val(),
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
            var pais = '<tr id="paises' + data.id + '"><td width="90%">' + data.nombre + '</td>';
            pais += '<td width="10%"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            pais += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#paises-list').append(pais);
            $('#frmc').trigger("reset");
            $("#res").html("Pais Registrado con Éxito");
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


////actualiza pais
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var pais_id = $('#pais_id').val();
        var formData = {nombre: $('#nombre').val(), id_usuario: $('#id_usuario').val(), }
        var my_url = url;
        my_url += '/mod/'+ pais_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data.nombre);
            var pais = '<tr id="paises' + data.id + '"><td width="90%">' + data.nombre + '</td>';
            pais += '<td width="10%"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            pais += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#paises" + pais_id).replaceWith(pais);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Pais Modificado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
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
    var route ="paises";
    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".paises").html(data);
        }
    });
});