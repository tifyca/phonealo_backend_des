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

  <div class="col-12">
    <div class="tile">
       {{-- FILTRO --}}
      <div class="col mb-3 ">
          <div class="row">
         
          <!--form class="row d-flex justify-content-end" action="{{route('clientes.index')}}" method="get"-->   
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Clientes</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Cliente">
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
          <!--/form-->
        
        </div>
        {{-- FIN FILTRO --}}

          <div class="tile-body">
            <div class="table-responsive">
              <div class="clientes" id="divclientes">
                <form>
                   @component('Registro/Clientes.lista')
                        @slot('clientes', $clientes)
                  @endcomponent
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