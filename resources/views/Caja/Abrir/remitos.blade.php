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
@section('display_back', '') @section('link_back', url('caja/abrir') )
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
              <thead>
                <tr class="table-secondary">
                  <th class="text-center">Remitos en Delivery</th>
                  <th class="text-center">Delivery</th>
                  <th class="text-center">Importe total</th>
                  <th class="text-center">Fecha</th>
                  {{-- <th class="text-center">Estado</th> --}}
                  <th class="text-center">Cobrar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($remitos as $remito)
                  <tr>
                    <td class="text-center">{{ $remito->id }}</td>
                    <td class="text-center">{{ $remito->nombre_delivery }}</td>
                    <td class="text-center">{!!number_format($remito->importe, 0, ',', '.')!!}</td>
                    <td class="text-center">{{ $remito->fecha }}</td>
                    {{-- <td class="text-center">{{ $remito->estado }}</td> --}}
                    <td class="text-center">
                      <a href="{{ route('caja.cobro_remito', $remito->id) }}" class="btn btn-primary confirm-delete">
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