@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Gasto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/gastos'))
@section('display_new','d-none')  @section('link_new', '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  
  <div class="col-12">
    <div class="tile">
        <div class="tile-body ">
             <form name="form1" action="{{route('gastos.store')}}" accept-charset="UTF-8"  method="post">
          {{ csrf_field() }}

                <div class="col-12 ">
                <div class="row">
                  
                    <div class="form-group col-md-6">
                      <label for="categoria_gasto">Categoría de Gastos</label>
                      <select class="form-control" id="categoria_gasto" name="categoria_gasto" required="">
                        <option value="">Seleccione</option>}
                         @foreach($categorias as $fuen)
                        <option value="{{$fuen->id}}">{{$fuen->categoria}}</option>
                        @endforeach
                      </select>
                    </div>


                    <div class="form-group col-md-6">
                      <label for="descripcion_gasto">Descripción</label>
                      <input class="form-control" type="text" id="descripcion_gasto" name="descripcion_gasto" placeholder="..." required="">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="categoria_gasto">Proveedores</label>
                      <select class="form-control" id="id_proveedor" name="id_proveedor">
                        <option value="">Seleccione</option>}
                         @foreach($proveedores as $fuen)
                        <option value="{{$fuen->id}}">{{$fuen->nombres}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="comprobante_gasto">Nro.Solicitud</label>
                      <select class="form-control" id="id_solped" name="id_solped">
                        <option value="">Seleccione</option>}
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="comprobante_gasto">Comprobante</label>
                      <input class="form-control" type="text" id="comprobante_gasto" name="comprobante_gasto" placeholder="..." required="">
                    </div>       

                    <div class="form-group col-md-4">
                      <label for="proveedor_gasto">Fuente</label>
                      <select class="form-control" id="id_fuente" name="id_fuente" required="">
                        <option value="">Seleccione</option>
                        @foreach($fuentes as $fuen)
                        <option value="{{$fuen->id}}">{{$fuen->fuente}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe_gasto">Importe</label>
                      <input class="form-control" type="text" id="importe_gasto" name="importe_gasto" placeholder="..." required="">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fecha_comprobante_gasto">Fecha Comprobante</label>
                      <input class="form-control" type="date" id="fecha_comprobante_gasto" name="fecha_comprobante_gasto" required="">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="divisa_gasto">Divisa</label>
                      <select class="form-control" id="divisa_gasto" name="divisa_gasto" required="">
                      <option value="">Seleccione</option>
                        @foreach($divisas as $fuen)
                        <option value="{{$fuen->id_divisa}}">{{$fuen->divisa}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="cambio_gasto">Cambio</label>
                      <input class="form-control" type="text" id="cambio_gasto" name="cambio_gasto" placeholder="...">
                    </div>
                   
                 
                    <div class="form-group col-md-12">
                      <label for="observaciones_gastos">Observaciones</label>
                      <textarea class="form-control" id="observaciones_gastos" name="observaciones_gastos" rows="3"></textarea>
                    </div>
                    <div class="tile-footer col-md-12">
                      <button class="btn btn-primary" type="submit">Guardar</button>
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
      
  $("input#importe_gasto").bind('keydown', function (event) {

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

 
      $("input#comprobante_gasto").bind('change', function (event) {
        var valor = $(this).val();
        document.form1.comprobante_gasto.value=valor.toUpperCase();
      });


      $("input#descripcion_gasto").bind('change', function (event) {
        var valor = $(this).val();
        document.form1.descripcion_gasto.value=valor.toUpperCase();
      });

     $("select#divisa_gasto").bind('change', function (event) {
        var valor = $(this).val();
        document.form1.cambio_gasto.value=valor;
     });

      $("select#id_proveedor").bind('change', function (event) {
        var valor = $(this).val();
        $("#id_solped").html('');
        $("#id_solped").append('<option value='+'>Solicitudes</option>');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({
          type: "GET",
          url: '{{ url('mostrar_solicitudes') }}',
          dataType: "json",
          data: { idc: valor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
            $.each(data, function(l, item1) {
             $("#id_solped").append('<option value='+item1.id+'>'+item1.id+'</option>');
           });
          }    


        });


      });

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