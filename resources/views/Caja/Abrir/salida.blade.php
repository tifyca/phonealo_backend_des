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
@section('display_back', '') @section('link_back', route('caja.abrir', $caja->id))
@section('display_new','d-none')  @section('link_new',  '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
  

  <div class="col-12 ">
    <div class="tile">
      <div class="row">
        <div class="col-md-6">
          <h3 class="tile-title text-center text-md-left">Salidas de Caja en Efectivo </h3>          
        </div>
        <div class="col-md-6 text-right">
           <button class="btn btn-primary" id="añadir"><i class="fa fa-fw fa-lg fa-plus"></i>Añadir</button>
        </div>
      </div>        
        <div class="tile-body ">
          <form action="{{ route('caja.registrarSalida') }}" method="post">
            {{ csrf_field() }} 
              <input type="hidden" name="caja" value="{{ $caja->id }}">           
              <div class="row fila" id="fila_inicial">
                <div class="form-group col-12  col-md-5">
                  <label class="control-label">Descripción</label>
                  <input class="form-control"  type="text" placeholder="Descripción de Salida" name="descripcionSalida[]" required>
                </div>
                <div class="form-group col-12  col-md-4">
                  <label class="control-label">Importe</label>
                  <input class="form-control"  type="number" placeholder="Ingrese un monto" min="1" name="importeSalida[]" required>
                </div>
                <div class="tile-footer col-12 col-md-2 text-center border-0" >
                  <button class="btn btn-primary col-7 delete">
                    <i class="fa fa-fw fa-lg fa-minus"></i>Eliminar
                  </button>
                </div>
              </div>
            <div id="filas"></div>

           {{--  <div class="row">
              <div class="form-group col-12  col-md-5">
                <label class="control-label">Descripción</label>
                <input class="form-control"  type="text" placeholder="Descripción de Salida" id="descripcionSalida" name="descripcionSalida[]">
              </div>
              <div class="form-group col-12  col-md-4">
                <label class="control-label">Importe</label>
                <input class="form-control"  type="text" placeholder="8888888" id="importeSalida" name="importeSalida[]">
              </div>
              <div class="tile-footer col-12 col-md-2 text-center border-0" >
                <button class="btn btn-primary col-7 delete">
                  <i class="fa fa-fw fa-lg fa-minus"></i>Eliminar
                </button>
              </div>
            </div> --}}

            <div class="tile-footer col-md-11 col-12  mx-3">
              <button  type="submit" class="btn btn-primary ">
                Guardar
              </button>
            </div>

          </form>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
<script>
$(function(){
  const fila = `
    <div class="row fila">
     <div class="form-group col-12  col-md-5">
      <label class="control-label">Descripción</label>
      <input class="form-control"  type="text" placeholder="Descripción de Salida" name="descripcionSalida[]" required>
    </div>
    <div class="form-group col-12  col-md-4">
      <label class="control-label">Importe</label>
      <input class="form-control"  type="number" placeholder="Ingrese un monto" min="1" name="importeSalida[]" required>
    </div>
    <div class="tile-footer col-12 col-md-2 text-center border-0" >
      <button class="btn btn-primary col-7 delete">
        <i class="fa fa-fw fa-lg fa-minus"></i>Eliminar
      </button>
    </div>
    </div>
  `;

  $(document).on('click', 'button.delete', function(e){
    e.preventDefault();
    $(this).parents('div.row.fila').remove().removeAttr('name');
  });

  $('#añadir').on('click', function(e){
    e.preventDefault();    
    $('#filas').append(fila);
  });

});

</script>
@endpush