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
            
            <div class="form-group col-md-2">
              <label for="categoria_gasto">Categoría de Gastos</label>
              <select class="form-control" id="categoria_gasto" name="categoria_gasto" required="">
                <option value="">Seleccione</option>}
                @foreach($categorias as $fuen)
                <option value="{{$fuen->id}}">{{$fuen->categoria}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="descripcion_gasto">Descripción</label>
              <input class="form-control" type="text" id="descripcion_gasto" name="descripcion_gasto" placeholder="..." required="" maxlength="50">
            </div>
            <div class="form-group col-md-2">
              <label for="proveedor_gasto">Fuente</label>
              <select class="form-control" id="id_fuente" name="id_fuente" required="">
                <option value="">Seleccione</option>
                @foreach($fuentes as $fuen)
                <option value="{{$fuen->id}}">{{$fuen->fuente}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-2">
              <label for="divisa_gasto">Divisa</label>
              <select class="form-control" id="divisa_gasto" name="divisa_gasto" required="">
                <option value="">Seleccione</option>
                @foreach($divisas as $fuen)
                <option value="{{$fuen->id_divisa}}">{{$fuen->divisa}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="cambio_gasto">Cambio</label>
              <input class="form-control" type="text" id="cambio_gasto" name="cambio_gasto" placeholder="...">
            </div>

            <div class="form-group col-md-4">
              <label for="proveedor">Proveedor</label>
              <select class="form-control" id="id_proveedor" name="id_proveedor" disabled="">
                <option value="">Seleccione</option>}
                @foreach($proveedores as $fuen)
                <option value="{{$fuen->id}}">{{$fuen->nombres}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="comprobante_gasto">Nro.Solicitud</label>
              <select class="form-control" id="id_solped" name="id_solped" disabled="">
                <option value="">Seleccione</option>}
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="importe_gasto">Total General Pedido</label>
              <input class="form-control" type="text" id="total" name="total" placeholder="..." readonly="">
            </div>
            <div class="form-group col-md-2">
              <label for="fecha_comprobante_gasto">Fecha Comprobante</label>
              <input class="form-control" type="date" id="fecha_comprobante_gasto" name="fecha_comprobante_gasto" required="">
            </div>

            <div class="form-group col-md-3">
              <label for="comprobante_gasto">Comprobante</label>
              <div id="comprobante1" style="display:block">
              <input class="form-control" type="text" id="comprobante_gasto" name="comprobante_gasto" placeholder="..." required="" maxlength="32">
            </div>
             <div id="comprobante2" style="display:none;">
              <select class="form-control" id="comprobante_gasto2" name="comprobante_gasto2">
                <option value="">Seleccione</option>}
              </select>              
            </div>
            </div>       
                    

            <div class="form-group col-md-3">
              <label for="importe_gasto">Importe</label>
              <input class="form-control" type="text" id="importe_gasto" name="importe_gasto" placeholder="..." required="">
            </div>
            
            <div class="form-group col-md-4">
              <label for="importe_gasto">Total Pedido Según Comprobante</label>
              <input class="form-control" type="text" id="totalf" name="totalf" placeholder="..." readonly="">
            </div>




            <div class="form-group col-md-12">
              <label for="observaciones_gastos">Observaciones</label>
              <textarea class="form-control" id="observaciones_gastos" name="observaciones_gastos" rows="3" maxlength="255"></textarea>
            </div>
            <div class="tile-footer col-md-12">
              <button class="btn btn-primary" name="guardar" type="submit">Guardar</button>
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


    $("input#descripcion_gasto").bind('change', function (event) {
      var valor = $(this).val();
      document.form1.descripcion_gasto.value=valor.toUpperCase();
    });

    $("select#divisa_gasto").bind('change', function (event) {
      var valor = $(this).val();
      document.form1.cambio_gasto.value=valor;
    });

    $("input#importe_gasto").bind('change', function (event) {
      var valor = $(this).val();
      var valor2 = $("#totalf").val();
      var nrosolped = $("#id_solped").val();

      if(nrosolped>0){

        if(valor != valor2){
          $("#rese").html("Importe de Gasto distinto al Total de la Solicitud de Pedido, Verifique proceso de Confirmación");
          $("#rese, #res-content").css("display","block");
          $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
          document.form1.guardar.disabled=true;
        }else{             document.form1.guardar.disabled=false;}
      }
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
           $("#id_solped").append('<option value='+item1.id+'>'+item1.nro_documento+'</option>');
         });
        }    

      });

    });


    $("select#id_solped").bind('change', function (event) {
      var valor = $(this).val();
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({
        type: "GET",
        url: '{{ url('buscar_solped') }}',
        dataType: "json",
        data: { idc: valor ,  _token: '{{csrf_token()}}' },
        success: function (data){
          console.log(data);         
          $("#total").val(data);      
        }    
      });
     $.ajax({
        type: "GET",
        url: '{{ url('buscar_comprobantes') }}',
        dataType: "json",
        data: { idc: valor ,  _token: '{{csrf_token()}}' },
     success: function (data){
          console.log(data);
          $.each(data, function(l, item1) {
           $("#comprobante_gasto2").append('<option value='+item1.nfactura+'>'+item1.nfactura+'</option>');
         });
        }    

      });

    });    

  });


  $("select#comprobante_gasto2").bind('change', function (event) {
    var valor = $(this).val();
    var ids  = $("#id_solped").val();
    document.form1.comprobante_gasto.value=valor.toUpperCase();
    comprobante = valor.toUpperCase();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $.ajax({
      type: "GET",
      url: '{{ url('buscar_factura') }}',
      dataType: "json",
      data: { factura: comprobante , ids: ids ,  _token: '{{csrf_token()}}' },
      success: function (data){
        console.log(data);  
        if(data.status == 'No'){       
          $("#rese").html("Comprobante No tiene productos confirmados en esta solicitud");
          $("#rese, #res-content").css("display","block");
          $("#rese, #res-content").fadeIn( 300 ).delay( 1800 ).fadeOut( 1500 );
          document.form1.guardar.disabled=true;       
        }
        if(data.status == 'Pagado'){       
          $("#rese").html("Comprobante Ya Cancelado");
          $("#rese, #res-content").css("display","block");
          $("#rese, #res-content").fadeIn( 300 ).delay( 1800 ).fadeOut( 1500 );
          document.form1.guardar.disabled=true;   
          
        }
        if(data.status == 'Ok'){ 
          $("#totalf").val(data.total); 
          //alert("paso");
        } 
      }    
    });


    

  });



  $("select#categoria_gasto").bind('change', function (event) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });
    $.ajax({
      type: "GET",
      url: '{{ url('buscar_categoria') }}',
      dataType: "json",
      data: { idc: $(this).val() , _token: '{{csrf_token()}}' },
      success: function (data){
              //var dataJson = eval(data);
              if(data.status == 'OK'){
                console.log(data);
                document.form1.id_proveedor.disabled=false;
                document.form1.id_solped.disabled=false;
                document.form1.id_fuente.disabled = true;
                document.form1.id_fuente.value = 1;
                document.getElementById('comprobante1').style.display='none';
                document.getElementById('comprobante2').style.display='block';

              //alert(data.result.primernombre);
            }if(data.status == 'NO'){
              document.form1.id_proveedor.disabled=true;
              document.form1.id_solped.disabled=true;
              document.form1.id_fuente.disabled = false;
                document.getElementById('comprobante1').style.display='block';
                document.getElementById('comprobante2').style.display='none';

            }


          }
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