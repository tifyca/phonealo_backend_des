@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Galería')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back',  url('registro/productos'))
@section('display_new','')  
@section('link_new')
{{ route('galeria.new',1) }}
@endsection 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <h3 class="tile-title text-center text-md-left">Nombre del Elemento/Producto</h3>
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Título</th>
                  <th>Img</th>
                  <th>Estatus</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tit.01</td>
                  <td class="text-center">
                    <img src="{{ asset('img/img-default.png') }}" class="img-fluid w-25" alt="">
                  </td>
                  <td>Activo</td>
                  <td class="text-center">
                    <a class="btn btn-primary" href="{{ route('galeria.update',2) }}"><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-trash"></i></a>
                      
                  </td>
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

@endpush