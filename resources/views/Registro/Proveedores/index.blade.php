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

<div class="row">
  <div class="col-12">
    <div class="tile">
      {{-- FILTRO --}}
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Proveedores</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" name="" placeholder="Buscar Proveedor">
            </div>
           <div class="form-group col-md-2">
              <input type="text" class="form-control" name="" placeholder="Buscar Email">
            </div>
           
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Estatus</option>
                <option>Activo</option>
                <option>Inactivo</option>
              </select>
            </div>
          </div>
        </div>
        {{-- FIN FILTRO --}}

          <div class="tile-body">
            <div class="table-responsive">
                <div class="proveedores">
                <form>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Proveedor</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>País</th>
                    <th>Email</th>
                    <th>RUC</th>
                    <th>Acciones</th>     
                  </tr>
                </thead>
                <tbody>
                  @foreach($proveedor as $Item)    
                  
                     <tr id="cliente{{$Item->id}}">
                      <td width="20%" >{{$Item->proveedor}}</td>
                      <td width="15%" >{{$Item->telefono}}</td>
                      <td width="25%" >{{$Item->direccion}}</td>
                      <td width="15%" >{{$Item->pais}}</td>
                      <td width="15%" >{{$Item->email}}</td>
                      <td width="15%" >{{$Item->ruc}}</td>
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm " href="proveedores/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $proveedor->render(); ?>
              </div>
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