<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Ver/Editar Proveedor')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_show', '') @section('link_back', url('registro/proveedores'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')
   <div style="display: none;" class="col-12 text-center alert alert-success" id="res"></div>
   <div style="display: none;" class="col-12 alert alert-danger" id="rese"> </div>          
<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <form>
          <input type="hidden" name="proveedor_id" id="proveedor_id" value="{{$proveedor->id}}">
           <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
           <input type="hidden" id="id_estado" name="id_estado" value="1">
            <div class="col-12">
             <div class="row">  
              <div class="form-group col-md-6">
                <label for="nombre_proveedor">Nombres</label>
                <input class="form-control read" type="text" id="nombre_proveedor" name="nombre_proveedor" placeholder="..." value="{{$proveedor->nombres}}" readonly >
              </div>
               <div class="form-group col-md-6">
                <label for="email_proveedor">Email</label>
                <input class="form-control read" id="email_proveedor" name="email_proveedor" type="email" aria-describedby="emailHelp" placeholder="..." value="{{$proveedor->email}}" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="direccion_proveedor">Dirección</label>
                <input class="form-control read" type="text" id="direccion_proveedor" name="direccion_proveedor" placeholder="..."  value="{{$proveedor->direccion}}" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="telefono_proveedor">Teléfono</label>
                <input class="form-control read" type="text" id="telefono_proveedor" name="telefono_proveedor" placeholder="..." value="{{$proveedor->telefono}}" onkeypress="return soloNumeros(event);" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="ruc_proveedor">RUC</label>
                <input class="form-control read" type="text" id="ruc_proveedor" name="ruc_proveedor" placeholder="..." value="{{$proveedor->ruc}}" onkeypress="return soloNumeros(event);" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="pais_proveedor">País</label>
                <select class="form-control paises read" id="pais_proveedor" name="pais_proveedor" disabled>
                  <option  value="{{$proveedor->id_pais}}">{{$proveedor->pais}}</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="tile-footer d-flex align-items-center">
                   <div class="form-check mr-3">
                    <label class="form-check-label">
                      <input class="form-check-input" id="editar" type="checkbox">Editar
                    </label>
                  </div>
                  <div class="">
                    <button class="btn btn-primary read" type="submit"  id="btn-edit" disabled>Guardar</button>
                  </div>
              </div>
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
<script src="{{asset('js/Registro/js_proveedores.js')}}"></script>
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
          url: '{{ route('paises_ajax') }}',
          dataType: "json",
          success: function (data){

            $(".paises").append('<option value=0> Seleccione </option>');
             $.each(data, function(i, item) {
           
              $(".paises").append('<option value='+item.id+'>'+item.nombre+'</option>');
             });
          }

      });

      });

</script>

@endpush