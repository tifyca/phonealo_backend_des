<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Ver/Editar Cliente')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/clientes'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')
      
<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <form>
          <input type="hidden" name="cliente_id" id="cliente_id" value="{{$cliente->id}}">
           <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="nombre_cliente">Nombres</label>
              <input class="form-control read" type="text" id="nombre_cliente" name="nombre_cliente" readonly value="{{$cliente->nombres}}" onkeypress="return soloLetras(event);" maxlength="50"  oncopy="return false">
            </div>
            <div class="form-group col-md-6">
              <label for="email_cliente">Email</label>
              <input class="form-control read" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" readonly value="{{$cliente->email}}"  oncopy="return false">
            </div>
            <div class="form-group col-md-6">
              <label for="telefono_cliente">Teléfonos</label>
              <input class="form-control read" type="text" id="telefono_cliente" name="telefono_cliente" readonly value="{{$cliente->telefono}}" onkeypress="return soloNumeros(event);" maxlength="15"  oncopy="return false">
              <input class="form-control read"  type="text" id="telefono_cliente2" name="telefono_cliente2" placeholder="..." value="{{$cliente->telefono2}}" onkeypress="return soloNumeros(event);" maxlength="15"  oncopy="return false" >
            </div>
            <div class="form-group col-md-6">
              <label for="ruc_cliente">RUC</label>
              <input class="form-control read" type="text" id="ruc_cliente" name="ruc_cliente" readonly value="{{$cliente->ruc_ci}}" onkeypress="return soloNumeros(event);" maxlength="13"  oncopy="return false">
            </div>
            <div class="form-group col-12 col-md-3">
              <label for="tipo_cliente">Tipo de Cliente</label>
              <select class="form-control read" id="tipo_cliente" name="tipo_cliente" disabled>
                <option value="">Seleccione</option>
                <option selected value="1">Natural</option>
                <option value="2">Jurídico</option>
              </select>
            </div>
            <div class="form-group col-12 col-md-3">
              <label for="departamento_cliente">Departamento</label>
              <select class="form-control departamento read" id="departamento_cliente" name="departamento_cliente" disabled >
                <option value="{{$cliente->id_departamento}}">{{$cliente->departamento}}</option>
                
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="ciudad_cliente">Ciudad</label>
              <select class="form-control ciudades read" id="ciudad_cliente" name="ciudad_cliente" disabled>
                <option  value="{{$cliente->id_ciudad}}">{{$cliente->ciudad}}</option>
                
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="barrio_cliente">Barrio</label>
              <select class="form-control barrios read" id="barrio_cliente" name="barrio_cliente" disabled>
                <option value="{{$cliente->barrio}}">{{$cliente->barrio}}</option>
                
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="direccion_cliente">Dirección</label>
              <input class="form-control read" type="text" id="direccion_cliente" name="direccion_cliente" readonly value="{{$cliente->direccion}}" maxlength="150">
            </div>
            <div class="form-group col-md-6">
              <label for="ubicacion_cliente">Ubicación</label>
              <input class="form-control read" type="text" id="ubicacion_cliente" name="ubicacion_cliente" readonly value="{{$cliente->ubicacion}}" onkeypress="return soloNumeros(event);">
            </div>
            <div class="form-group col-12">
              <label for="nota_cliente">Nota</label>
              <textarea class="form-control read" id="nota_cliente" name="nota_cliente" rows="3" disabled >{{$cliente->notas}}</textarea>
            </div>
            <div class="col-md-12 ">
               <label>Estatus</label>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input read" value="1" type="radio" id="status" name="status" <?php if($cliente->id_estado=="1") echo 'checked="checked"';?>  disabled>Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input class="form-check-input read" value="0" type="radio" id="status2" name="status"  <?php if($cliente->id_estado=="0") echo 'checked="checked"';?> disabled>Inactivo
                      </label>
                    </div>
                  </div>
            <div class="tile-footer col-12 pl-3 row">
              <div class="form-check mx-3 mt-2">
                <label class="form-check-label">
                  <input class="form-check-input" id="editar" type="checkbox">Editar
                </label>
              </div>

              <button class="btn btn-primary" id="btn-edit">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
<meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Registro/js_cliente.js')}}"></script>
  <script type="text/javascript" charset="utf-8" async defer>
    $('#editar').change(function(){
      if ($('#editar').prop('checked')){

        $('.read').prop('readonly', false);
        $('.read').prop('disabled', false);

      }
      else{
        $('.read').prop('readonly', true);
        $('.read').prop('disabled', true);
      }
    });

   
  $(document).ready(function(){
    {{-- SE LLENA EL SELECT DE LOS DEPARTAMENTOS CON AJAX --}}
 
      $.ajax({

          type: "get",
          url: '{{ route('departamentos_ajax') }}',
          dataType: "json",
          success: function (data){

             $.each(data, function(i, item) {
            
              $(".departamento").append('<option value='+item.id+'>'+item.nombre+'</option>');
              });
          }

      });
      // AL SELECCIONAR EL DEPARTAMENTO SE ENVIA EL ID Y SE RECIBE LAS CIUDADES
      $('#departamento_cliente').change(function(){
        var id_departamento = $(this).val();


          $(".ciudades").html('');

           $.ajax({
              type: "get",
              url: '{{ route('ciudadesCombo') }}',
              dataType: "json",
              data: {id_departamento: id_departamento},
              success: function (data){

                $(".ciudades").append('<option value=0> Seleccione </option>');

                 $.each(data, function(l, item1) {

                   //$(".ciudades option:eq(1)").prop("selected", true);
                   $(".ciudades").append('<option value='+item1.id+'>'+item1.ciudad+'</option>');
                  });
              }
          });
      });

      // AL SELECCIONAR CIUDAD SE ENVIA EL ID Y SE RECIBE LOS BARRIOS
      $('#ciudad_cliente').change(function(){
        var id_ciudad = $(this).val();


          $(".barrios").html('');

           $.ajax({
              type: "get",
              url: '{{ route('barriosCombo') }}',
              dataType: "json",
              data: {id_ciudad: id_ciudad},
              success: function (data){
                $(".barrios").append('<option value=0> Seleccione </option>');

                 $.each(data, function(l, item2) {

                   //$(".ciudades option:eq(1)").prop("selected", true);
                   $(".barrios").append('<option value='+item2.barrio+'>'+item2.barrio+'</option>');
                  });
              }
          });
      });

  
  });
</script>
 
@endpush