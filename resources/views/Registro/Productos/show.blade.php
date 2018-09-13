@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nuevo Producto')
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
        <form name="form1" action="{{route('productos.store')}}" accept-charset="UTF-8"  method="post"  enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-9">
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="codigoproducto">Código Producto</label>
                  <input class="form-control" type="text" id="codigo_producto" name="codigo_producto" placeholder="...">
                </div>
                <div class="form-group col-md-6">
                  <label for="nombre_producto">Nombre Producto</label>
                  <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="...">
                </div>
                <div class="form-group col-md-3">
                  <label for="cod_barra_producto">Código de Barras</label>
                  <input class="form-control" type="text"  name="cod_barra_producto" id="cod_barra_producto" placeholder="...">
                </div>
                <div class="form-group col-md-3">
                  <label for="categoria_producto">Categoría</label>
                  <select class="form-control" id="id_categoria" name="id_categoria">
                    <option value="">Seleccione</option>
                    @foreach($categorias as $cate)
                    <option value="{{$cate->id}}">{{$cate->categoria}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="categoria_producto">Subcategoría</label>
                  <select class="form-control" id="id_subcategoria" name="id_subcategoria">
                    <option value="">Seleccione</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="precio_minimo_producto">Precio Mínimo</label>
                  <input class="form-control" id="precio_minimo" name="precio_minimo" type="text" placeholder="...">
                </div>
                <div class="form-group col-md-3">
                  <label for="precio_ideal_producto">Precio Ideal</label>
                  <input class="form-control" type="text" id="precio_ideal" name="precio_ideal" placeholder="...">
                </div>
                <div class="form-group col-12">
                  <label for="descripcion_producto">Descripción</label>
                  <textarea class="form-control" id="descripcion_producto" name="descripcion_producto" rows="8"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="row">
                
                <div class="form-group  text-center mt-3">
                  <label for="imagen_producto" align="center"><b>Imagen del Producto</b></label><br>
                  <img id="imgSalida" src="{{ asset('img/img-default.png') }}" class="img-fluid " alt="">
                  <label>Mínimo 512 x 256 píxeles | JPG y PNG</label>
                  <div class="form-group mt-4">
                    <input type="file" class=" read-file read" id="archivo" name="archivo" accept="image/*">                    </div>
                  </div>
                  <div class="tile-footer col-12 text-center mt-3">
                    <button class="btn btn-primary" type="submit">Guardar</button>
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
  <script type="text/javascript" language="javascript">
    $ = jQuery;
    jQuery(document).ready(function () {
      
  $("input#precio_ideal").bind('keydown', function (event) {

      if(event.shiftKey)
      {
        event.preventDefault();
      }
      if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 241 )    {
      }
      else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
          }
        } 
        else {
          if (event.keyCode < 96 || event.keyCode > 105) {
            event.preventDefault();
          }
        }
      }        
      ;
    });    

 
  $("input#precio_minimo").bind('keydown', function (event) {

      if(event.shiftKey)
      {
        event.preventDefault();
      }
      if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 241 )    {
      }
      else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
          }
        } 
        else {
          if (event.keyCode < 96 || event.keyCode > 105) {
            event.preventDefault();
          }
        }
      }        
      ;
    });    
      $("input#codigo_producto").bind('change', function (event) {
        var valor = $(this).val();
        document.form1.codigo_producto.value=valor.toUpperCase();
      });


      $("input#cod_barra_producto").bind('change', function (event) {
        var valor = $(this).val();
        document.form1.cod_barra_producto.value=valor.toUpperCase();
      });


      $("select#id_categoria").bind('change', function (event) {
        var valor = $(this).val();
        $("#id_subcategoria").html('');
        $("#id_subcategoria").append('<option value='+'>Subcategoria</option>');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({
          type: "GET",
          url: '{{ url('mostrar_subcategorias') }}',
          dataType: "json",
          data: { idc: valor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
            $.each(data, function(l, item1) {
             $("#id_subcategoria").append('<option value='+item1.id+'>'+item1.sub_categoria+'</option>');
           });
          }    


        });


      });

    });

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