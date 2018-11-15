 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Registro de Remitos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', route('caja.abrir', $caja->id) )
@section('display_new','d-none')  @section('link_new', '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12">
    <div class="tile">
      <h3 class="tile-title text-center text-md-left">Cobros de Remitos </h3>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead class="table-secondary text-center">      
                <th># Remito</th>
                <th>Delivery</th>
                <th>Importe total</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Cobrar</th>
              </thead>
              <tbody class="text-center">
                @foreach ($remitos as $remito)                  
                  <tr class="{{ ($remito->id_estado == 11) ? 'alert alert-danger' : '' }}">
                    <td>{{ $remito->id }}</td>
                    <td>{{ $remito->nombre_delivery }}</td>
                    <td>{!!number_format($remito->importe, 0, ',', '.')!!}</td>
                    <td>{{ $remito->fecha }}</td>
                    <td>{{ $remito->estado }}</td>
                    <td>
                      <a href="{{ route('caja.cobro_remito', [$remito->id, 'caja' => $caja->id]) }}" class="btn btn-primary confirm-delete">
                      {{-- <a href="{{ route('caja.cobro_remito', $remito->id, $caja->id) }}" class="btn btn-primary confirm-delete"> --}}
                        <i class="fa m-0 fa-money"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $remitos->render() }}
          </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush