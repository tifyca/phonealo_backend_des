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

                      @if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif    
    <div style="display: none;" class="col-12 text-center alert alert-success" id="res"></div>
   <div style="display: none;" class="col-12 alert alert-danger" id="rese"> </div>                  

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Repartidores</h3>
        <div class="tile-body ">
          <div class="table-responsive">
             <div class="empleados">
               <form>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="empleados-list" name="empleados-list">
                  @foreach($empleados as $Item)    
                  
                     <tr id="empleado{{$Item->id}}">
                      <td width="20%" >{{$Item->nombres}}</td>
                      <td width="15%" >{{$Item->telefono}}</td>
                      <td width="25%" >{{$Item->email}}</td>
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <a class="btn btn-primary" href="empleados/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                       <button class="btn btn-primary confirm-delete" value="{{$Item->id}}"><i class="fa fa-lg fa-trash"></i></button>    
                           
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $empleados->render(); ?>
              </div>
              </form>
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