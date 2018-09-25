<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nuevo Proveedor')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/proveedores'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')
  @if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif    

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
         <form id="formproveedor" name="formproveedor"  novalidate="">
           <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
          <input type="hidden" id="id_estado" name="id_estado" value="1">
              {{ csrf_field() }} 
           <div class="col-12">
          <div class="row">
              <div class="form-group col-md-6">
                <label for="nombre_proveedor">Nombres</label>
                <input class="form-control" type="text" id="nombre_proveedor" name="nombre_proveedor" onkeypress="return soloLetrasNum(event);"  placeholder="..." maxlength="50"  oncopy="return false">
              </div>
              <div class="form-group col-md-6">
                <label for="email_proveedor">Email</label>
                <input class="form-control" id="email_proveedor" name="email_proveedor" type="email" aria-describedby="emailHelp" placeholder="..." maxlength="50"  oncopy="return false">
              </div>
              <div class="form-group col-md-6">
                <label for="direccion_proveedor">Dirección</label>
                <input class="form-control" type="text" id="direccion_proveedor" name="direccion_proveedor" placeholder="..." maxlength="150"  oncopy="return false">
              </div>
              <div class="form-group col-md-6">
                <label for="telefono_proveedor">Teléfonos</label>
                <input class="form-control" type="text" id="telefono_proveedor" name="telefono_proveedor" placeholder="..." onkeypress="return soloNumeros(event);" maxlength="13"  oncopy="return false">
                <input class="form-control" type="text" id="telefono_proveedor2" name="telefono_proveedor2" placeholder="..." onkeypress="return soloNumeros(event);" maxlength="13"  oncopy="return false">
              </div>
              <div class="form-group col-md-6">
                <label for="ruc_proveedor">RUC</label>
                <input class="form-control" type="text" id="ruc_proveedor" name="ruc_proveedor" maxlength="13" placeholder="..." onkeypress="return soloNumeros(event);" maxlength="15"  oncopy="return false">
              </div>
              <div class="form-group col-md-6">
                <label for="pais_proveedor">País</label>
                <select class="form-control paises" id="pais_proveedor" name="pais_proveedor">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="tile-footer">
                <button class="btn btn-primary" type="submit" id="btn-save">Guardar</button>
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
<script  type="text/javascript" charset="utf-8">
$(document).ready(function(){
    {{-- SE LLENA EL SELECT DE LOS DEPARTAMENTOS CON AJAX --}}
      $.ajax({
          type: "get",
          url: '{{ route('paises_ajax') }}',
          dataType: "json",
          success: function (data){

             $.each(data, function(i, item) {

            
              $(".paises").append('<option value='+item.id+'>'+item.nombre+'</option>');
              });
          }

      });

      });

</script>
@endpush