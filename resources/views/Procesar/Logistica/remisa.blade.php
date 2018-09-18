<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Remisa')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('procesar/logistica'))
@section('display_new','d-none')  @section('link_edit', '')
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Nuevo Cargo</h3>
          <form id="frmc" name="frmc"  novalidate="">
            {{ csrf_field() }} 
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
            <div class="row">
             
              <div class="form-group col-6">
                <label class="control-label">Repartidores</label>
                <select name="" class="form-control" >
                  <option value="">Seleccione</option>
                  <option value="">Repartidores</option>
                </select>
              </div>
              <div class="tile-footer col-12 col-md-2 text-center border-0" >
                <button class="btn btn-primary save"  id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>
              </div>
            </div>
          </form>
        <div class="tile-body ">
        </div>  
    </div>
  </div>

  
  <div class="col-12">
    <div class="tile">
      <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Fecha Activo</th>
                    <th>Ciudad</th>
                    <th>Horario</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
                   
                  </tr>
                </thead>
                <tbody>

                  <tr >
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    
                  </tr>
                  <tr class="table-active">
                    <td colspan="9" class="text-right"><h4>Total de la Remisa:</h4></td>
                    <td><h4>000000</h4></td>
                  </tr>
          
                </tbody>
              </table>
            </div>
       
    </div>
  </div>
</div>
  
      
     
     
     
    </div>
   </div>
  </div>

 </div>



@endsection

@push('scripts')

 

 
@endpush

