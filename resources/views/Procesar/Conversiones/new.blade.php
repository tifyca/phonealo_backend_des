 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nueva Lista')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('procesar/conversiones'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content') 
              

<div class="row d-flex justify-content-center">
  <div class="col-md-6">
    <div class="tile">
        <div class="tile-body ">
          <form id="" name=""  novalidate="">
            <div class="row d-flex justify-content-center">
              <div class="form-group col-12">
                <label class="control-label">Nombre Lista</label>
                <input class="form-control"  type="text" placeholder="..." id="nombreLista" name="nombreLista" >

              </div>
              <div class="form-group col-md-12">
                <div class="row">
                  <div class="form-group col-12">
                    <div class="row  no-guuters">
                      <div class="col-9">
                      <label for="descripcion">Descripción</label>
                      <input class="form-control" autocomplete="off" type="text" id="descripcion" name="descripcion" >
                    </div>
                      <div class="col-3 d-flex align-items-end">
                        <button class="btn btn-primary w-100"  id="" ><i class="fa fa-fw fa-lg fa-plus"></i>Añadir</button>
                      </div>
                    </div>
                    
                      
                    {{-- ESTE SE LLENA CON EL ID DEL PRODUCTO --}}
                    <input type="hidden" id="id_producto"  name="id_producto">
                    {{-- //// --}}
                  </div>
                  
                  <div class="selec_productos col-12 d-none">
                    <ul class="list-group" id="list-productos">
                       {{-- ESTE ESPACIO APARECE Y SE LLENA CON AJAX, SE ACATUALIZA CADA QUE SUELTAS LA TECLA --}}
                    </ul>
                  </div>
                  {{-- //// --}}
                </div>
              </div>
              <div class="form-group col-md-7 opacity-p">
                <img src="{{ asset('img/img-default.png') }}" alt="" class="w-100">
              </div>
             
            </div>
          </form>
        </div>  
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
        <div class="tile-body ">
            <div class="row">
              <h4 class="tile-title text-center text-md-left col-9">Productos Agregados</h4>
              <div class="col-3">
                <button class="btn btn-primary w-100"  id="" >Guardar</button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Sandwichera para 2 panes/ S141</td>
                    <td><a class="btn btn-primary" href=""><i class="m-0 fa fa-lg fa-times"></i></a></td>
                  </tr>
                  <tr>
                    <td>Sandwichera para 2 panes/ S141</td>
                    <td><a class="btn btn-primary" href=""><i class="m-0 fa fa-lg fa-times"></i></a></td>
                  </tr>
                  <tr>
                    <td>Sandwichera para 2 panes/ S141</td>
                    <td><a class="btn btn-primary" href=""><i class="m-0 fa fa-lg fa-times"></i></a></td>
                  </tr>
                  <tr>
                    <td>Sandwichera para 2 panes/ S141</td>
                    <td><a class="btn btn-primary" href=""><i class="m-0 fa fa-lg fa-times"></i></a></td>
                  </tr>
                  <tr>
                    <td>Sandwichera para 2 panes/ S141</td>
                    <td><a class="btn btn-primary" href=""><i class="m-0 fa fa-lg fa-times"></i></a></td>
                  </tr>
                  <tr>
                    <td>Sandwichera para 2 panes/ S141</td>
                    <td><a class="btn btn-primary" href=""><i class="m-0 fa fa-lg fa-times"></i></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>  
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

<script  type="text/javascript" charset="utf-8" >
   //CAPTURA AL SOLTAR EL TECLADO Y DESATA EL EVENTO Y BUSCA EL PRODUCTO.
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
            $('#id_producto').val(data.id);
                
          }

        });


    }
</script>
  
@endpush