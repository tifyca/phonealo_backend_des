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
        
            <form class="row d-flex justify-content-end" action="{{route('proveedores.index')}}" method="get">  
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Proveedores</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" name="proveedor" placeholder="Proveedor">
            </div>
           <div class="form-group col-md-2">
              <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
           
            <div class="form-group col-md-2">
              <select class="form-control" id="estatus" name="estatus">
                <option value="">Estatus</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            <div class="col-md-1">
              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              
            </div>
          </form>
         
        </div>
        {{-- FIN FILTRO --}}

          <div class="tile-body">
            <div class="table-responsive">
                <div class="proveedores">
                <form>
              <table class="table table-hover" id="sampleTable">
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
                      <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm m-0" href="proveedores/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
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