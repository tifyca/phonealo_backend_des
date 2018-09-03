var url = "barrios";

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del barrio
$(document).on('click', '.open_modal', function () {
    var barrio_id = $(this).val();
    $.get(url + '/edit/' + barrio_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#barrio_id').val(data.id);
        $('#nombre').val(data.barrio);
        $('#latedit').val(data.lat);
        $('#lonedit').val(data.lon);
       // $('select[name=ciudades-select-edit]').val(data.id_ciudad);
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   barrio
$(document).on('click', '.confirm-delete', function () {
    var barrio_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#barrio-id').val(barrio_id);
});


// eliminar el barrio y eliminarlo de la lista
$(document).on('click', '.delete-barrio', function () {

    var barrio_id = $('#barrio-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + barrio_id,
        success: function (data) {
            console.log(data);
            $("#barrios" + barrio_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Barrio Eliminado con Éxito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
// crear nuevo barrio
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var id_dptos=$('.departamento').val();
    var id_ciudads=$('.ciudades').val();
    var formData = {
        nombre: $('#nombreBarrio').val(),
        id_dpto:$('.departamento').val(),
        id_ciudad:$('.ciudades').val(), 
        lat:$('#latedit').val(),
        lon:$('#lonedit').val(),
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
            //var barrio = '<tr id="barrios' + data.id + '"><td>' + data.barrio + '</td>';
            //barrio += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            //barrio += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            //$('#barrios-list').append(barrio);
           // $('#frmc').trigger("reset");
            $('#nombreBarrio').val("");
            $('#lon').val("");
            $('#lat').val("");
           // $(".departamento option:eq(1)").prop("selected", true);
            $(".departamento ").val("");
            $(".ciudades ").val("");
            $('select[name=departamento-select-list]').val(id_dptos);
            $('select[name=ciudades-select-list]').val(id_ciudads);

           $.get(url + '/ciud/' + data.id_ciudad, function(ciud){
               $.each(ciud, function(l, item1) {

                var barrio = '<tr id="barrios' + item1.id + '"><td>' + item1.barrio + '</td>';
                    barrio += '<td width="10%"><div class="btn-group"><button class="btn btn-primary open_modal" value="' + item1.id + '"><i class="fa fa-lg fa-edit"></i></button>';
                    barrio += ' <button class="btn btn-primary confirm-delete" value="' + item1.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#barrios-list').append(barrio);

                 });
            
                 }),

            $("#res").html("Barrio Registrada con Éxito");
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


////actualiza barrio
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var barrio_id = $('#barrio_id').val();
        var formData = { nombre: $('#nombre').val(),
                         id_usuario: $('#id_usuario').val(),
                         barrio_id:$('#barrio_id').val(),
                        // id_dpto:$('.departamento').val(),
                         //id_ciudad:$('.ciudades').val(), 
                         lat:$('#latedit').val(),
                         lon:$('#lonedit').val(), }
        var my_url = url;
        my_url += '/mod/'+ barrio_id;
   
    console.log(formData);
    $.ajax({
        type:"PUT",
        url: my_url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data.barrio);
             var barrio = '<tr id="barrios' + data.id + '"><td>' + data.barrio + '</td>';
            barrio += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            barrio += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#barrios" + barrio_id).replaceWith(barrio);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Barrio Modificado con Éxito");
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

function soloNumeros(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46) || (keynum == 45))
return true;
return /\d/.test(String.fromCharCode(keynum));
}