@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nueva Oferta')
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
       <form name="form1" action="{{route('ofertas.store')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
        
        <div class="col-12 ">
          <div class="row">
            <div class="form-group col-md-2">
              <label for="cod_entrada">Cod.</label>
              <input class="form-control" type="text" id="cod_producto" name="cod_producto" readonly="">
              <input type="hidden" name="idproducto" id="idproducto">
            </div>
             <div class="col-lg-8">
                <label for="titulo" ><b>Producto</b></label>
                <input class="form-control" autocomplete="off" placeholder="Producto" name="descripcion" id="descripcion" required>    
             </div>
             <div class="selec_productos col-12 d-none">
              <ul class="list-group" id="list-productos">
               {{-- ESTE ESPACIO APARECE Y SE LLENA CON AJAX, SE ACATUALIZA CADA QUE SUELTAS LA TECLA --}}
             </ul>
           </div>
            <div class="form-group col-md-2">
                <label for="precio_oferta" class="uk-form-label"><b>Precio Oferta</b></label>
                  <input type="text" name="precio_oferta" id="precio_oferta" class="form-control" placeholder="Precio Oferta" required>
             </div> 
             <div class="form-group col-md-4">
                <label class="uk-form-label"><b>Home</b></label>
                 <div class="animated-radio-button">
                  <label><input class="form-group" type="radio" name="home" id="home1" checked value="1" required><span class="label-text"> Si</span></label>
                
                  <label><input class="form-group" type="radio" name="home" id="home2" value="0" required><span class="label-text"> No</span></label>
               </div>
             </div>
             <div class="form-group col-md-4">
                <label class="uk-form-label"><b>Publico</b></label>
                 <div class="animated-radio-button">
                  <label><input class="form-group" type="radio" name="publico" id="publico1" checked value="1" required><span class="label-text"> Si</span></label>
                
                  <label><input class="form-group" type="radio" name="publico" id="publico2" value="0" required><span class="label-text"> No</span></label>
               </div>
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
           
             {{--  --}}      
         </div>
         <div class="tile-footer col-md-12">
              <button class="btn btn-primary" name="guardar" type="submit">Guardar</button>
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
  <script type="text/javascript" charset="utf-8" async defer>
    // REFRESCA LOS CAMPOS DE SELCCION DE PRODUCTO
    $('#refrescar').click(function(){
      $('#descripcion').val('');
      $('#cod_producto').val('');
      $('#stock').val('');
      $('#precio').val('');
      $('#id_producto').val('');
    });
    //CAPTURA AL SOLTAR EL TECLADO Y DESATA EL EVENTO Y BUSCA EL PRODUCTO.
    $('#nro_documento').keyup(function(event) {
        $valor=$('#this').val();
        if($valor!=""){
          document.form1.descripcion.disabled = false
        }
    });
    $('#descripcion').keyup(function(event) {
      var descripcion = $(this).val();
      if (descripcion.length > 0) {
        $.ajax({
          type: "get",
          url: '{{ route('productos_ajax') }}',
          dataType: "json",
          cache: false,
          data: { producto: descripcion },
          success: function (data){
            if (data.length == 0) {
              $('.selec_productos').addClass('d-none');
              $('.opacity-p').css('opacity','1');
            }else{
              $('.selec_productos').removeClass('d-none');
              $('.opacity-p').css('opacity','0.3');
              $('#list-productos').html('');
              $.each(data, function(l, item) {
                $('#list-productos').append('<li onclick="captura(this)" data-value='+item.id+' class="list-group-item list-group-item-action cursor-pointer"><div class="row no-gutters d-flex align-items-center"><div class="col mr-1">'+item.descripcion+'</div><div class="col-1 ml-1"><span class="badge badge-primary badge-pill ">'+item.stock_activo+'</span></div></div></li>');
              });
            }
          }
        });
      }else{
        $('.selec_productos').addClass('d-none');
        $('.opacity-p').css('opacity','1');
      }
    });

    function captura(elemento){
      var value = $(elemento).data('value');
      $('.selec_productos').addClass('d-none');
      $('.opacity-p').css('opacity','1');
      $.ajax({
        type: "get",
        url: '{{ route('producto_click') }}',
        dataType: "json",
        cache: false,
        data: { id_producto: value },
        success: function (data){
          $('#descripcion').val(data.descripcion);
          $('#idproducto').val(data.id);
          $('#cod_producto').val(data.codigo_producto);
          $('#id_producto').val(data.id);
        }
      });
    }

  </script>
  
@endpush