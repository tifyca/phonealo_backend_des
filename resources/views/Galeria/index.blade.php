@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Galería')
@section('descripcion', '')

{{-- ACCIONES --}}

@section('display_back', '') @section('link_back',  url('registro/productos'))
@section('display_new','')  
@section('link_new')
{{ route('galeria.new',$id) }}
@endsection 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <h3 class="tile-title text-center text-md-left">{{$nombre}}</h3>
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
                @foreach($galeria as $ficha)
                <tr>
                  <td>{{$ficha->titulo}}</td>
                  <td class="text-center">
                  <?php 
                      $url=$ficha->img;
                       if($url)
                        //$zurl="img/productos/".$url;
                        $zurl = config('app.url') . 'productos/' . $url ;
                      else
                        $zurl = 'img/img-default.png';
                      //echo $zurl;
                  ?>                    
                    <img src="{{ asset($zurl) }}" class="img-fluid w-25" alt="">
                  </td>
                  <td>{{$ficha->estatus}}</td>
                  <td class="text-center">
                    <a class="btn btn-primary" href="{{ route('galeria.edit',$ficha->id) }}"><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-trash"></i></a>
                      
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
           <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $galeria->render(); ?>
              </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

@endpush