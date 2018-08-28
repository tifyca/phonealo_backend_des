@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Paises')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Nuevo País</h3>
        <div class="tile-body ">
          <form>
            <div class="row">
               <div class="form-group col-12  col-md-4">
                <label class="control-label">País</label>
                <input class="form-control" type="text" placeholder="Nombre País">
              </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
 
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado Paises</h3>
        <div class="tile-body ">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="paises-list" name="paises-list">
                @foreach ($paises as $item)
                 <tr>
                  <td>{{ $item->nombre }}</td>
                  <td width="10%">
                    <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>
              {{ $paises->links() }}
          </div>
        </div>
    </div>
  </div>
 
</div>

  

@endsection

@push('scripts')

@endpush