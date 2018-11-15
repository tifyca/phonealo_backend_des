 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Detalle de Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', route('caja.abrir', $caja->id))
@section('display_new','d-none')  @section('link_new', url('') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12">
    
    <div class="tile">

      <form action="{{ route('caja.detalle') }}" method="get" class="row d-flex justify-content-end">
        {{ csrf_field() }}
        <input type="hidden" name="caja" value="{{ $caja->id }}">
        <div class="form-group col-md-3">
          <select class="form-control" name="tipo">
          {{-- <option value="10">Todos los ingresos</option> --}}
          <option value="0">Todos los movimientos</option>
          <option value="4">Todas las Salidas</option>
          <option value="1">Ingresos Efectivo</option>
          <option value="2">Ingresos POS</option>}
          <option value="3">Otros Ingresos</option>}
          </select>
        </div>      
        <div class="col-md-1 p-0">          
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
      </form>      
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead {{-- class="text-center" --}}>
                <tr class="table-secondary">
                  <th>Descripción</th>
                  <th>Tipo</th>
                  <th>Referencia</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody {{-- class="text-center" --}}>             
                @foreach ($detalles as $detalle)
                  <tr>
                    <td>{{ $detalle->descripcion }}</td>
                    <td>{{ $detalle->tipo }}</td>
                    <td>{{ $detalle->referencia }}</td>
                    <td>{!!number_format($detalle->importe, 0, ',', '.')!!}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $detalles->appends( Request::only(['caja','tipo']) )->links() }}
          </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush