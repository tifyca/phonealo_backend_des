var url = "montos_delivery";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del monto
$(document).on('click', '.open_modal', function () {
    var monto_id = $(this).val();
    $.get(url + '/edit/' + monto_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#id').val(data.id);
        $('#monto').val(data.monto);
        

        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   monto
$(document).on('click', '.confirm-delete', function () {
    var monto_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#monto-id').val(monto_id);
});


// eliminar el monto y eliminarlo de la lista
$(document).on('click', '.delete-monto', function () {

    var monto_id = $('#monto-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + monto_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#monto" + monto_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Categoría Eliminada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo eliminar el monto");
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }
    });
});
// crear nuevo monto
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        monto: $('#monto').val(),
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
          
            var monto = '<tr id="monto' + data.id + '"><td width="30%">' + data.monto + '</td><td width="30%">';
            monto += '<td width="15%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            monto += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#montos-list').append(monto);
            $('#frmc').trigger("reset");
            $("#res").html("Monto Registrado con Éxito");
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


////actualiza monto
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var monto_id = $('#monto_id').val();
        var formData = { monto: $('#monto').val(),  
                         id_usuario: $('#id_usuario').val(), 
                       }
        var my_url = url;
        my_url += '/mod/'+ monto_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            var monto = '<tr id="monto' + data.id + '"><td width="30%">' + data.monto + '</td>';
            monto += '<td width="15%" class="text-center"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            monto += ' <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
           $("#monto" + monto_id).replaceWith(monto);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Categoría Modificada con Éxito");
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
    var route ="montos_delivery";
    $.ajax({
        url: route,
        data: {page: page,
               montos: $('#buscarmonto').val(),
             
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".montos").html(data);
        }
    });
});

$(document).on('click','#btnBuscar',function(e){
   

    var route ="montos_delivery";
    $.ajax({
        url: route,
        data: {montos: $('#buscarmonto').val(),
         
        type: 'GET',
        dataType: 'json',
        success: function(data){
          
            $("#divmontos").html(data);

        }
    });
});

$(document).on('click','.save',function(e){
    e.preventDefault();

   var route ="montos_delivery";
    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $(".montos").html(data);
        }
    });
});