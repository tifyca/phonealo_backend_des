<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Clientes')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/clientes/show') ) 
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
       {{-- FILTRO --}}
      <div class="col mb-3 text-center">
         
          <form class="row d-flex justify-content-end" action="{{route('clientes.index')}}" method="get">   
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Clientes</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" name="cliente" placeholder="Cliente">
            </div>
           <div class="form-group col-md-2">
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
           
            <div class="col-md-1 mr-md-3">

              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              
            </div>
          </form>
        
        </div>
        {{-- FIN FILTRO --}}

          <div class="tile-body">
            <div class="table-responsive">
              <div class="clientes">
                <form>
              <table class="table table-hover " id="sampleTable">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="clientes-list" name="clientes-list">
                  @foreach($clientes as $Item)    
                  
                     <tr id="cliente{{$Item->id}}">
                      <td width="20%" >{{$Item->nombres}}</td>
                      <td width="15%" >{{$Item->telefono}}</td>
                      <td width="15%" >{{$Item->email}}</td>
                      <td width="25%" >{{$Item->direccion}}</td>
                      <td width="15%" >{{$Item->barrio}}</td>
                      <td width="15%" >{{$Item->ciudad}}</td>
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <a class="btn btn-primary btn-sm m-0" href="clientes/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                   
                     @if(empty($Item->ubicacion)) 
                     <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm m-0"  style="pointer-events: none; cursor: default; opacity: .6"  ><i class="fa fa-lg fa-globe"></i></a>
                     @else
                     <a data-toggle="tooltip" data-placement="top" title="Mapa" class="btn btn-primary btn-sm m-0"  href="clientes/gmaps/{{$Item->ubicacion}}" ><i class="fa fa-lg fa-globe"></i></a>
                     @endif                
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $clientes->render(); ?>
              </div>
              </form>
            </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Registro/js_cliente.js')}}"></script>
 <script  type="text/javascript" charset="utf-8">
   

 </script>

  
@endpush