@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Ver/Editar Ofertas')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('ecommerce/ofertas'))
@section('display_new','d-none')  @section('link_new', '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section ('content')
<div class="row">

  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <form name="form1" action="{{ route('ofertas.update', ($producto->id)) }}" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
         {{ csrf_field() }}
         {{ method_field('PUT') }} 
            <div class="col-12">
              <div class="row">
                <div class="form-group col-md-2">
              <label for="cod_entrada">Cod.</label>
              <input class="form-control" value="{{$producto->codigo_producto}}" type="text" id="cod_producto" name="cod_producto" readonly="">
              <input type="hidden" name="idproducto" id="idproducto" value="{{$producto->id}}">
            </div>
             <div class="col-lg-8">
                <label for="titulo" ><b>Producto</b></label>
                <input class="form-control" readonly="" placeholder="Producto" name="descripcion" id="descripcion" value="{{$producto->descripcion}}" required>    
             </div>
            <div class="form-group col-md-2">
                <label for="precio_oferta" class="uk-form-label"><b>Precio Oferta</b></label>
                  <input type="text" name="precio_oferta" id="precio_oferta" class="form-control" placeholder="Precio Oferta" value="{{$producto->precio_oferta}}" required>
             </div> 
             <div class="form-group col-md-4">
                <label class="uk-form-label"><b>Home</b></label>
                 <div class="animated-radio-button">
                  <label><input class="form-group" type="radio" name="home" id="home1" checked value="1" required><span class="label-text"> Si</span></label>
                
                  <label><input class="form-group" type="radio" name="home" id="home2" value="0" required><span class="label-text"> No</span></label>
               </div>
             </div>
          <div class="form-group col-md-8">
            <div class="form-group col-md-6">
              <?php 
                        $url=$producto->banner_oferta;
                         if(!empty($url))   
                          $zurl = config('app.url') . '/banner/' . $url ;
                        else
                          $zurl = 'img/silueta2.png';
                      ?>
                    <img id="imgSalida" src="{{asset($zurl)}}" width="100%"> 
                      <label class="control-label">Seleccionar Imagen</label>
                  <input type="file" class=" read-file read" id="archivo" name="archivo" accept="image/*">
                </div>
            </div>
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
</script>
 
<script type="text/javascript" language="javascript">
    $ = jQuery;
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