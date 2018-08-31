@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Detalle Producto')
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
            <h2>Nombre del Producto</h2>
            <table class="table mt-4">
              <tbody>
                <tr>
                  <th>Código:</th>
                  <td>0000</td>
                </tr>
                <tr>
                  <th>Categoría:</th>
                  <td>Lorem</td>
                </tr>
                <tr>
                  <th>Subcategoria:</th>
                  <td>Lorem</td>
                </tr>
                <tr>
                  <th>Precio Ideal:</th>
                  <td>00.000 Gs</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-12">
             <h3>Especificaciones</h3>
              <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quasi quam veniam quod numquam labore, earum eos rem cumque reprehenderit voluptatum ea autem, odit maxime rerum dicta. Aliquid, velit, dicta.</div>
              <div>In repudiandae fugit minima animi obcaecati velit odit voluptatum vitae enim nobis deserunt, fuga tempore inventore perspiciatis et quidem esse dicta culpa tenetur. Ab ea similique, illo ipsum aliquam quibusdam!</div>
              <div>Debitis harum doloribus sunt id, animi necessitatibus reiciendis fuga exercitationem molestias tenetur, dolores illum consequuntur optio, ducimus cumque accusamus officia aspernatur porro non nobis. Mollitia omnis voluptate quidem recusandae. Excepturi.</div>
              <div>Ducimus eligendi pariatur incidunt illo quisquam cupiditate quod optio, repellat nostrum nesciunt porro ipsum est at. Vitae culpa beatae harum! Ipsum modi laborum similique ea dignissimos maiores, ducimus laboriosam cupiditate.</div>
              <div>Quia ducimus, porro illum fugit repudiandae ipsam, obcaecati magnam quod expedita, laboriosam voluptatibus id? Reiciendis fugit, eius modi voluptatum quod qui. Harum labore, velit hic odio aut aliquid quo amet!</div>
              <div>Ad libero exercitationem tenetur quos sequi pariatur voluptatem soluta voluptates molestias odio explicabo corrupti doloremque numquam dolores illum cumque ut, necessitatibus incidunt ducimus vel culpa reprehenderit quidem doloribus nulla? Praesentium!</div>
              <div>Consequuntur sed tempora, earum! Atque incidunt aut suscipit, sapiente totam vero similique quibusdam mollitia voluptates, sit fuga quos quas et qui corporis sed facere sint vitae ipsum nemo asperiores doloremque.</div>
              <div>Saepe totam veritatis, impedit maiores inventore quidem dignissimos quas ea voluptas dolores quia voluptatum accusantium dolor, culpa consequatur libero, dolorem. Sint dolores, distinctio modi nihil ut ipsam corrupti, similique consequuntur.</div>
              <div>Neque nam aliquam architecto adipisci molestias ut sint dolorem. Ipsa soluta laboriosam labore, optio quam temporibus distinctio sit, nam tempore tenetur ad quis dolores fuga cum quas nesciunt facere, quo!</div>
              <div>Dicta doloribus fuga saepe quo fugit eius, rerum, eum quaerat voluptate adipisci ea eos inventore, voluptas libero aliquam officiis, perspiciatis consequatur porro similique accusantium. Nisi harum voluptatibus, rerum reiciendis nobis.</div>  
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
              <img class="d-block w-100" src="{{ asset('img/1.jpg') }}" alt="First slide">
            </div>
            {{-- ///////////// --}}
            {{-- Imagenes de galiria de producto --}}
            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('img/2.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('img/3.jpg') }}" alt="Third slide">
            </div>
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