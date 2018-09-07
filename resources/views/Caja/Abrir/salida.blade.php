 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Registrar Salida')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('caja/abrir'))
@section('display_new','d-none')  @section('link_new',  '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
  

  <div class="col-12 ">
    <div class="tile">
        
      <h3 class="tile-title text-center text-md-left">Salidas de Caja en Efectivo </h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
            <div class="row">
              {{--  --}}
              <div class="col-12">
                <div class="row">
                  <div class="form-group col-12  col-md-5">
                    <label class="control-label">Descripción</label>
                    <input class="form-control"  type="text" placeholder="Descripción de Salida" id="descripcionSalida" name="descripcionSalida">
                  </div>
                  <div class="form-group col-12  col-md-4">
                    <label class="control-label">Importe</label>
                    <input class="form-control"  type="text" placeholder="8888888" id="importeSalida" name="importeSalida">
                  </div>
                  <div class="tile-footer col-12 col-md-2 text-center border-0" >
                    <button class="btn btn-primary col-7"  id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-minus"></i>Eliminar</button>
                  </div>
                </div>
              </div>
              {{--  --}}
              <div class="col-12">
                <div class="row">
                  <div class="form-group col-12  col-md-5">
                    <label class="control-label">Descripción</label>
                    <input class="form-control"  type="text" placeholder="Descripción de Salida" id="descripcionSalida" name="descripcionSalida">
                  </div>
                  <div class="form-group col-12  col-md-4">
                    <label class="control-label">Importe</label>
                    <input class="form-control"  type="text" placeholder="8888888" id="importeSalida" name="importeSalida">
                  </div>
                  <div class="tile-footer col-12 col-md-2 text-center border-0" >
                    <button class="btn btn-primary col-7"  id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-plus"></i>Añadir</button>
                  </div>
                </div>
              </div>
              {{--  --}}
              <div class="tile-footer col-md-11 col-12  mx-3">
                    <button class="btn btn-primary "  id="btn-save" value="add">Guadar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush