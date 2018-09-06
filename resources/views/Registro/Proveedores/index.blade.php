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
    <div style="display: none;" class="col-12 text-center alert alert-success" id="res"></div>
   <div style="display: none;" class="col-12 alert alert-danger" id="rese"> </div>              

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Proveedores</h3>
        <div class="tile-body ">
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
                      <a class="btn btn-primary" href="Proveedores/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
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