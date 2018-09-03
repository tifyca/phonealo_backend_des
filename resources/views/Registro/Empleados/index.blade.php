@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Empleados')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','') 	@section('link_new', url('registro/empleados/show')) 
@section('display_edit', 'd-none')		@section('link_edit', '')
@section('display_trash','d-none')		@section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Repartidores</h3>
        <div class="tile-body ">
          <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>000000000</td>    
                    <td>example@example.com</td>
                    <td width="10%" class="text-center">
                    	<div class="btn-group">
                    		<a class="btn btn-primary" href="{{ route('empleados.update',2) }}"><i class="fa fa-lg fa-eye"></i></a>
                    		<a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                    	</div>
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