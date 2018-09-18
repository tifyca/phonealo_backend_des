<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Proveedores')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/proveedores/show') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
@if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif    

  <div class="col-12">
    <div class="tile">
      {{-- FILTRO --}}
      <div class="col mb-3 text-center">
      <div class="row">
        
           
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Proveedores</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" name="proveedor" id="proveedor" placeholder="Proveedor">
            </div>
           <div class="form-group col-md-2">
              <input type="text" class="form-control" name="email" id="email" placeholder="Email">
            </div>
           
            <div class="form-group col-md-2">
              <select class="form-control" id="status" name="status">
                <option value="">Estatus</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            <div class="col-md-1">
                  <button  id="btnBuscar" class="btn btn-primary">Filtrar</button>  
              
            </div>
   
         
        </div>
        {{-- FIN FILTRO --}}

          <div class="tile-body">
            <div class="table-responsive">
                <div class="proveedores" id="divproveedores">
                <form>
                  @component('Registro/Proveedores.lista')
                        @slot('proveedor', $proveedor)
                  @endcomponent
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Registro/js_proveedores.js')}}"></script>
@endpush