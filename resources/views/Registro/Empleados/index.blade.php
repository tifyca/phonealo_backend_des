<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Empleados')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','') 	@section('link_new', url('registro/empleados/show')) 
@section('display_edit', 'd-none')		@section('link_edit', '')
@section('display_trash','d-none')		@section('link_trash')

@section('content')

       

  <div class="col-12">  


  <div class="col-12">
    <div class="tile">
     
      {{-- FILTRO --}}
      <div class="col mb-3 text-center">
          <div class="row">
          
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Empleados</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" name="empleado" id="empleado" placeholder="Empleado">
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
            <div class="col-md-1 mr-md-3">
                <button  id="btnBuscar" class="btn btn-primary">Filtrar</button>  
              
            </div>
          </div>
        </div>
        {{-- FIN FILTRO --}}
        
        <div class="tile-body ">
          <div class="table-responsive">
             <div class="empleados" id="divempleados">
           
                 @component('Registro/Empleados.lista')
                        @slot('empleados', $empleados)
                  @endcomponent
          
            </div>
            </div>
        </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
            
                <div class="modal-header">
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar Empleado</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea Eliminar este Empleado?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-empleado" >Si</button>
                    <input type="hidden" id="empleado-id" name="empleado-id" value="0">
                </div>
            </div>
        </div>
   </div>


@endsection

@push('scripts')
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Registro/js_empleados.js')}}"></script>
  
@endpush