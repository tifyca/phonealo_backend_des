@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Detalle del Producto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/productos'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-md-8">
    <div class="tile">
      <div class="tile-body">
        <div class="row">
          <div class="col-12 table-responsive">
            <h2>{{$productos->descripcion}}</h2>
            <table class="table mt-4">
              <tbody>
                <tr>
                  <th>Código:</th>
                  <td>{{$productos->codigo_producto}}</td>
                </tr>
                <tr>
                  <th>Categoría:</th>
                  <td>{{$categoria}}</td>
                </tr>
                <tr>
                  <th>Subcategoria:</th>
                  <td>{{$productos->id_subcategoria}} {{$subcategoria}}</td>
                </tr>
                <tr>
                  <th>Precio Ideal:</th>
                  <td>{{$productos->precio_ideal}} Gs</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-12">
             <h3>Especificaciones</h3>
             <p ><?php echo html_entity_decode($productos->descripcion_producto)?> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
   <div class="col-md-4 text-center">
      <div id="carouselProducto" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            {{-- Imagen principal --}}
            <div class="carousel-item active">
                <?php $url=$productos->img;
                       if($url)
                        $zurl = config('app.url') . '/productos/' . $url ;
                        //$zurl="img/productos/".$url;

                      else
                        $zurl = 'img/img-default.png';
                      //echo $zurl;
                      
                  ?>              
                  <img class="d-block w-100" src="{{ asset($zurl) }}" alt="First slide">
            </div>
            {{-- ///////////// --}}
            {{-- Imagenes de galiria de producto --}}
            @foreach($imagenes as $img)
              <?php 
                 //$url = 'img/productos/'.$img->imagen;
                 $url = config('app.url') . 'productos/' . $img->imagen ;
                 if(!$url) $dir ='img/2.jpg';
                 else      $dir=$url; 
              ?>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset($dir) }}" alt="Second slide">
            </div>
            @endforeach
            {{-- ////////////////////////////// --}}
          </div>
          <a class="carousel-control-prev" href="#carouselProducto" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselProducto" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>
</div>

  

@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush