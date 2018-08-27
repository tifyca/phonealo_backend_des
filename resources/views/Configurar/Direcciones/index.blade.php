@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Direcciones')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Nuevo Departamento</h3>
        <div class="tile-body ">
          <form>
            <div class="row">
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Departamento</label>
                <input class="form-control" type="text" placeholder="Nombre Departamento">
              </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Nueva Ciudad</h3>
        <div class="tile-body ">
          <form>
            <div class="row">
              <div class="form-group col-12 col-md-3">
                <label for="exampleSelect1">Departamento</label>
                <select class="form-control departamento" id="">
                 <option value="">Seleccione</option>
                </select>
              </div>
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Ciudad</label>
                <input class="form-control" type="text" placeholder="Nombre Ciudad">
              </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Nuevo Barrio</h3>
        <div class="tile-body ">
          <form>
            <div class="row">
              <div class="form-group col-12 col-md-3">
                <label for="departamento-select">Departamento</label>
                <select class="form-control departamento" id="departamento-select">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="form-group col-12 col-md-3">
                <label for="">Ciudades</label>
                <select class="form-control ciudades" id="">
                  <option value="">Seleccione</option>
                </select>
              </div>
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Barrio</label>
                <input class="form-control" type="text" placeholder="Nombre Barrio">
              </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
 
</div>

  

@endsection

@push('scripts')
<script  type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    {{-- SE LLENA EL SELECT DE LOS DEPARTAMENTOS CON AJAX --}}
      $.ajax({
          type: "get",
          url: '{{ route('departamentos') }}',
          dataType: "json",
          success: function (data){

             $.each(data, function(i, item) {

                $(".departamento").append('<option value='+item.id+'>'+item.nombre+'</option>');
              });
          }

      });
      // AL SELECCIONAR EL DEPARTAMENTO SE ENVIA EL ID Y SE RECIBE LAS CIUDADES
      $('#departamento-select').change(function(){
        var id_departamento = $(this).val();

           $.ajax({
              type: "get",
              url: '{{ route('ciudades') }}',
              dataType: "json",
              data: {id_departamento: id_departamento},
              success: function (data){

                 $.each(data, function(l, item1) {

                    $(".ciudades").append('<option value='+item1.id+'>'+item1.ciudad+'</option>');
                  });
              }
          });
      });
  });
</script>
@endpush