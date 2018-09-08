@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nueva Imagen')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('galeria/index'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
           <form name="form1" action="{{route('galeria.store')}}" accept-charset="UTF-8"  method="post"  enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group col-md-8">
                  <label for="titulo_galeria">Título</label>
                  <input type="hidden" name="id_producto" id="id_producto" value="{{$id}}">
                  <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Título de imagen">
                </div>
                <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" value="1" type="radio" id="estatus1" name="estatus">Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input class="form-check-input" value="0" type="radio" id="estatus2" name="estatus">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
           <div class="form-group col-md-4 text-center mt-3">
              <img id="imgSalida" src="{{ asset('img/img-default.png') }}" class="img-fluid " alt="">  
              <div class="form-group mt-4">
                <input type="file" class="form-control-file" id="archivo" name="archivo" accept="image/*">
              </div>
            </div>


            <div class="tile-footer col-12 pl-3">
              <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

  <script type="text/javascript" language="javascript">
    $(function() {
    $('#archivo').change(function(e) {
      addImage(e); 
    });

    function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;
      if (!file.type.match(imageType))
       return;

     var reader = new FileReader();
     reader.onload = fileOnload;
     reader.readAsDataURL(file);
   }

   function fileOnload(e) {
    var result=e.target.result;
    $('#imgSalida').attr("src",result);
  }
});
  </script>
@endpush