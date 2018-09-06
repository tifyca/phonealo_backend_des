@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar producto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/productos'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <form name="form1" action="{{route('productos.update',$productos->id)}}" accept-charset="UTF-8" method="post">
          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
          {{ method_field('PUT') }}     
          <div class="row">
            <div class="col-md-8">
              <div class="row">

                <div class="form-group col-md-2">
                  <label for="codigo_producto">Id</label>
                  <input class="form-control read" type="text" id="idp" name="idp"  value="{{$productos->id}}" readonly="">
                </div>

                <div class="form-group col-md-3">
                  <label for="codigo_producto">Código Producto</label>
                  <input class="form-control read" type="text" id="codigo_producto" name="codigo_producto"  value="{{$productos->codigo_producto}}" readonly>
                </div>
                <div class="form-group col-md-7">
                  <label for="nombre_producto">Nombre Producto</label>
                  <input class="form-control read" type="text" id="nombre_producto" name="nombre_producto" value="{{$productos->descripcion}}" readonly >
                </div>
                <div class="form-group col-md-4">
                  <label for="cod_barra_producto">Código de Barras</label>
                  <input class="form-control read" type="text" id="cod_barra_producto" name="cod_barra_producto" {{$productos->cod_barra_producto}} readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="categoria_producto">Categoría</label>
                  <select class="form-control read" id="categoria_producto" name="categoria_producto" disabled>
                    <option value="">Seleccione</option>
                    @foreach($categorias as $cate)
                    <option value="{{$cate->id}}" @if($cate->id==$productos->id_categoria) selected="" @endif>{{$cate->categoria}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="categoria_producto">Subcategoría</label>
                  <select class="form-control read" id="categoria_producto" name="categoria_producto" disabled>
                    <option value="">Seleccione</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="precio_minimo_producto">Precio Mínimo</label>
                  <input class="form-control read" id="precio_minimo_producto" name="precio_minimo_producto" type="text" value="{{$productos->precio_minimo}}" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="precio_ideal_producto">Precio Ideal</label>
                  <input class="form-control read" type="text" id="precio_ideal_producto" name="precio_ideal_producto" value="{{$productos->precio_ideal}}" readonly>
                </div>
                <div class="form-group col-12">
                  <label for="descripcion_producto">Descripción</label>
                  <textarea class="form-control read" id="descripcion_producto" name="descripcion_producto" rows="8" disabled>{{$productos->descripcion_producto}}</textarea>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <label for="imagen_producto">Imagen del Producto</label>
                <div class="form-group col-12 text-center mt-3">

                  <img id="imgSalida" src="{{ asset('img/img-default.png') }}" class="img-fluid " alt="">

                  <div class="form-group mt-4">
                    <input type="file" class=" read-file read" id="file-input" name="file-input" accept="image/*"disabled>
                  </div>
                </div>
                <div class="tile-footer d-flex align-items-center col-12">
                 <div class="form-check mr-3">
                  <label class="form-check-label">
                    <input class="form-check-input" id="editar" type="checkbox">Editar
                  </label>
                </div>
                <div class="">
                  <button class="btn btn-primary read" type="submit" disabled>Guardar</button>
                </div>
              </div>
            </div>

          </div>

        </div>
      </form>
    </div>
  </div>
</div>
</div>



@endsection

@push('scripts')
<script type="text/javascript" charset="utf-8" async defer>
  $('#editar').change(function(){
    if ($('#editar').prop('checked')){

      $('.read').prop('readonly', false);
      $('.read').prop('disabled', false);

    }
    else{
      $('.read').prop('readonly', true);
      $('.read').prop('disabled', true);
    }
    document.form1.idp.disabled=true; 
    
    
  });

    $(function() {
    $('#file-input').change(function(e) {
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

<script>
  var editor_config = {
    path_absolute : "{{ URL::to('/') }}/",
    selector: "textarea",
    plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime media nonbreaking save table contextmenu directionality",
    "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
  tinymce.init(editor_config);
</script>

@endpush