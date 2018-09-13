@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Productos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/productos/show') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
  @if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif      
<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <div class="col mb-3 text-center">
          <div class="row ">
            <div class="col">
              <h4 class="tile-title text-center text-md-left">Listado de Productos</h4>
            </div>
            <form class="row d-flex justify-content-end" action="{{route('productos.index')}}" method="get"> 
              <div class="form-group col-md-3">
                <input class="form-control" type="text" name="valor" id="valor" placeholder="Producto">
              </div>
              <div class="form-group col-md-3">
                <select class="form-control" id="id_categoria" name="id_categoria" ">
                  <option value="">Categoría</option>
                  @foreach($categorias as $cate)
                  <option value="{{$cate->id}}">{{$cate->categoria}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <select class="form-control" id="id_subcategoria" name="id_subcategoria">
                  <option value="">Subcategoria</option>
                </select>
              </div>
              <div class="col-md-1 mr-md-5">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              </div>
            </form>
          </div>
        </div>
     
          <div class="table-responsive">
            <table class="table table-hover " id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Categoría</th>
                  <th>Descompuesto</th>
                  <th>Stock</th>
                  <th>Precio Ideal</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productos as $ficha)
                <tr >
                  <td class="" >{{$ficha->id}}</td>
                  <td>{{$ficha->codigo_producto}}</td>
                  <td>{{$ficha->descripcion}}</td>
                  <td>
                     @foreach($categorias as $categoria)
                      @if($categoria->id==$ficha->id_categoria)
                         {{$categoria->categoria}}
                      @endif
                     @endforeach
                    
                  </td>
                  <td>{{$ficha->descompuesto}}</td>
                  <td>{{$ficha->stock_minimo}}</td>
                  <td><?php 
                      $precio = number_format($ficha->precio_ideal, 2, ',', '.');
                  echo $precio;?></td>
                 <?php 
                      $url=$ficha->img;
                       if($url)
                        //$zurl="img/productos/".$url;
                        $zurl = config('app.url') . '/productos/' . $url ;
                      else
                        $zurl = 'img/img-default.png';
                      //echo $zurl;
                  ?>

                  <td class="text-center"><img src="{{ asset($zurl) }}" class="img-fluid" width="100px" alt=""></td> 
                  <td class="text-center">
                    <div class="btn-group">
                      <a data-toggle="tooltip" data-placement="top" title="Ver/Editar" class="btn btn-primary" href="{{ route('productos.edit',$ficha->id) }}" ><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a data-toggle="tooltip" data-placement="top" title="Detalle" class="btn btn-primary" href="{{ route('productos.detalle',$ficha->id) }}" title="Ver Detalle"><i class="m-0 fa fa-lg fa-info"></i></a>
                      <a data-toggle="tooltip" data-placement="top" title="Galería" class="btn btn-primary" href="{{ route('galeria.index',$ficha->id) }}" title="Ver Galería de Imágenes"><i class="m-0 fa fa-lg fa-image"></i></a>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
           <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $productos->render(); ?>
              </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

<script type="text/javascript" language="javascript">
  $ = jQuery;
  jQuery(document).ready(function () {

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

    $("input#boton").bind('click', function (event) {
      $("form").submit();
    });
    
 });



</script>
@endpush