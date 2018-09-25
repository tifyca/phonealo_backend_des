var url = "departamentos";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del dpto
$(document).on('click', '.open_modal', function () {
    var dpto_id = $(this).val();
    $.get(url + '/edit/' + dpto_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#dpto_id').val(data.id);
        $('#nombre').val(data.nombre);
        
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   dpto
$(document).on('click', '.confirm-delete', function () {
    var dpto_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#dpto-id').val(dpto_id);
});


// eliminar el dpto y eliminarlo de la lista
$(document).on('click', '.delete-dpto', function () {

    var dpto_id = $('#dpto-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + dpto_id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#dpto" + dpto_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Departamento Eliminado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo Eliminar el Departamento, por que está Asociado a una Ciudad");
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }
    });
});
// crear nuevo dpto
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreDpto').val(),
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
            var dpto = '<tr id="dpto' + data.id + '"><td width="90%">' + data.nombre + '</td>';
            dpto += '<td width="10%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            dpto += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#dpto-list').append(dpto);
            $('#frmc').trigger("reset");
            $("#res").html("Departamento Registrado con Éxito");
            $("#res, #res-content, #res-content").css("display","block");
            $("#res, #res-content, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
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


////actualiza dpto
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var dpto_id = $('#dpto_id').val();
        var formData = {nombre: $('#nombre').val(), id_usuario: $('#id_usuario').val(), }
        var my_url = url;
        my_url += '/mod/'+ dpto_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data.nombre);
             var dpto = '<tr id="dpto' + data.id + '"><td width="90%">' + data.nombre + '</td>';
            dpto += '<td  width="10%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            dpto += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#dpto" + dpto_id).replaceWith(dpto);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Departamento Modificado con Éxito");
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
    var route ="departamentos";
    $.ajax({
        url: route,
        data: {page: page, scope: $('#scope').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".departamentos").html(data);
        }
    });
});

$(document).on('click','#btnBuscar',function(e){
   

    var route ="departamentos";
    $.ajax({
        url: route,
        data: {scope: $('#scope').val()},
        type: 'GET',
        dataType: 'json',
        success: function(data){
          
            $("#divdeparatementos").html(data);

        }
    });
});


$(document).on('click','.save',function(e){
    e.preventDefault();

    var route ="departamentos";
    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".departamentos").html(data);
        }
    });
});


