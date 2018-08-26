var url = "cargos";
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

// muestra el formulario modal para la edición del cargo
$(document).on('click', '.open_modal', function () {
    var cargo_id = $(this).val();
    $.get(url + '/edit/' + cargo_id, function(data){
          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        //success data
        console.log(data);
        $('#cargo_id').val(data.id);
        $('#nombre').val(data.cargo);
        if (data.status==1){
        $('input:radio[id=status]').prop("checked", true);
        }
        if (data.status==0){
        $('input:radio[id=status2]').prop("checked", true);
        }
        $('#myModal').modal('show');
    });
    
});

// muestra modal para la confirmar eliminar   cargo
$(document).on('click', '.confirm-delete', function () {
    var cargo_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#cargo-id').val(cargo_id);
});


// eliminar el cargo y eliminarlo de la lista
$(document).on('click', '.delete-cargo', function () {

    var cargo_id = $('#cargo-id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + cargo_id,
        success: function (data) {
            console.log(data);
            $("#cargo" + cargo_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Cargo Eliminado con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
// crear nuevo cargo
$("#btn-save").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
    var formData = {
        nombre: $('#nombreCargo').val(),
        status: $('input:radio[name=statusCargo]:checked').val(),
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
            var cargo = '<tr id="cargo' + data.id + '"><td>' + data.cargo + '</td>'+(data.status==1 ? '<td>' + act + '</td>':'<td>' + ina + '</td>');
            cargo += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            cargo += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
          
            $('#cargos-list').append(cargo);
            $('#frmc').trigger("reset");
            $("#res").html("Cargo Registrado con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


////actualiza cargo
$("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        var cargo_id = $('#cargo_id').val();
        var formData = {nombre: $('#nombre').val(), status: $('input:radio[name=status]:checked').val(), }
        var my_url = url;
        my_url += '/mod/'+ cargo_id;
   
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
            var cargo = '<tr id="cargo' + data.id + '"><td>' + data.cargo + '</td>'+(data.status==1 ? '<td>' + act + '</td>': '<td>' + ina + '</td>');
            cargo += '<td><div class="btn-group"><button class="btn btn-primary open_modal" value="' + data.id + '"><i class="fa fa-lg fa-edit"></i></button>';
            cargo += ' <button class="btn btn-primary confirm-delete" value="' + data.id + '"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>';
            $("#cargo" + cargo_id).replaceWith(cargo);
            $('#frmc').trigger("reset");
            $('#myModal').modal('hide');
            $("#res").html("Cargo Modificado con Exito");
            $("#res").css("display","block");
            $("#res").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});