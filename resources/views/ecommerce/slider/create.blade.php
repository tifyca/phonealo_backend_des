@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Slider')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('ecommerce/slider'))
@section('display_new','d-none')  @section('link_new', '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section ('content')
<div class="row">

  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
       <form name="form1" action="{{route('slider.store')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}

        <div class="col-12 ">
          <div class="row">

             <div class="form-group col-md-1">
                <label class="uk-form-label"><b>Público</b></label>
                 <div class="animated-radio-button">
                  <label><input class="form-group" type="radio" name="publico" id="publico1" checked value="1" required><span class="label-text"> Si</span></label>
                
                  <label><input class="form-group" type="radio" name="publico" id="publico2" value="0" required><span class="label-text"> No</span></label>
               </div>
             </div>
             {{--  --}}
            <div class="col-lg-8">
                <label for="titulo" ><b>Título</b></label>
                <input class="form-control" placeholder="Título" name="descripcion" id="descripcion"  required>
                
             </div>
            
               <div class="form-group col-md-2">
                <label for="posicion" class="uk-form-label"><b>Posición</b></label>
                  <input type="text" name="posicion" id="posicion" class="form-control" placeholder="Posición">
             </div>
           
        <div class="form-group col-md-8">
            <div class="form-group col-md-6">
              <img id="imgSalida" src="{{asset('img/silueta2.png')}}" width="100%">
              
                <div class="form-group">
                  <label class="control-label">Seleccionar Imagen</label>
                  <input type="file" class=" read-file read" id="archivo" name="archivo" accept="image/*">
                </div>
              
            </div>
             {{--  --}}
           
             {{--  --}}
             <div class="tile-footer col-md-12">
              <button class="btn btn-primary" name="guardar" type="submit">Guardar</button>
            </div>      
         </div>
      </div>
      </div>
  </form>
</div>
@endsection

@push('scripts')
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