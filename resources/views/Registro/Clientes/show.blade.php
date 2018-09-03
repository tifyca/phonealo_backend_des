<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Cliente')
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
          <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
              {{ csrf_field() }} 
          <div class="row">
            <div class="form-group col-md-6">
              <label for="nombre_cliente">Nombres</label>
              <input class="form-control" type="text" id="nombre_cliente" name="nombre_cliente" placeholder="...">
            </div>
            <div class="form-group col-md-6">
              <label for="email_cliente">Email</label>
              <input class="form-control" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" placeholder="...">
            </div>
            <div class="form-group col-md-6">
              <label for="telefono_cliente">Teléfono</label>
              <input class="form-control" type="text" id="telefono_cliente" name="telefono_cliente" placeholder="...">
            </div>
            <div class="form-group col-md-6">
              <label for="ruc_cliente">RUC</label>
              <input class="form-control" type="text" id="ruc_cliente" name="ruc_cliente" placeholder="...">
            </div>
            <div class="form-group col-12 col-md-3">
              <label for="tipo_cliente">Tipo de Cliente</label>
              <select class="form-control" id="tipo_cliente" name="tipo_cliente">
                <option value="">Seleccione</option>
                <option selected value="N">Natural</option>
                <option value="J">Jurídico</option>
              </select>
            </div>
            <div class="form-group col-12 col-md-3">
              <label for="departamento_cliente">Departamento</label>
              <select class="form-control departamento" id="departamento_cliente" name="departamento_cliente">
                <option value="0">Seleccione</option>
                
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="ciudad_cliente">Ciudad</label>
              <select class="form-control ciudades" id="ciudad_cliente" name="ciudad_cliente">
                <option value="0">Seleccione</option>
                
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="barrio_cliente">Barrio</label>
              <select class="form-control barrios" id="barrio_cliente" name="barrio_cliente">
                <option value="0">Seleccione</option>
                
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="direccion_cliente">Dirección</label>
              <input class="form-control" type="text" id="direccion_cliente" name="direccion_cliente" placeholder="...">
            </div>
            <div class="form-group col-md-6">
              <label for="ubicacion_cliente">Ubicación</label>
              <input class="form-control" type="text" id="ubicacion_cliente" name="ubicacion_cliente" placeholder="...">
            </div>
            <div class="form-group col-12">
              <label for="nota_cliente">Nota</label>
              <textarea class="form-control" id="nota_cliente" name="nota_cliente" rows="3"></textarea>
            </div>
            <div class="tile-footer col-12 pl-3">
              <button class="btn btn-primary" type="submit">Guardar</button>
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
<script  type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    {{-- SE LLENA EL SELECT DE LOS DEPARTAMENTOS CON AJAX --}}
      $.ajax({
          type: "get",
          url: '{{ route('departamentos_ajax') }}',
          dataType: "json",
          success: function (data){

             $.each(data, function(i, item) {

              //$(".departamento option:eq(1)").prop("selected", true);
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

                 $.each(data, function(l, item2) {

                   //$(".ciudades option:eq(1)").prop("selected", true);
                   $(".barrios").append('<option value='+item2.id+'>'+item2.barrio+'</option>');
                  });
              }
          });
      });

  
  });
</script>
@endpush