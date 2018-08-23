@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Repartidores')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','') 	@section('link_new', url('registro/repartidores/show')) 
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
                    <th>Entra</th>
                    <th>Sale</th>
                    <th>Pago</th>
                    <th>Gastos</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td class="text-center">
                      <a class="btn btn-success" href="#"><i class="m-0 fa fa-lg fa-clock-o"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="" method="get" accept-charset="utf-8">
                        <div class="form-group">
                          <input id="party" class="form-control" type="time" name="partydate" value="">
                        </div>
                      </form> 
                    </td>
                    <td class="text-center">
                      <a class="btn btn-success" href="{{ route('repartidores.pagos',1) }}"><i class="m-0 fa fa-lg fa-usd"></i></a>
                    </td>
                    <td class="text-center">
                      <a class="btn btn-danger" href="{{ route('repartidores.gastos',2) }}"><i class="m-0 fa fa-lg fa-usd"></i></a>
                    </td>     
                                 
                    <td width="10%" class="text-right">
                    	<div class="btn-group">
                    		<a class="btn btn-primary" href="{{ route('repartidores.update',2) }}"><i class="fa fa-lg fa-edit"></i></a>
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
  <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush