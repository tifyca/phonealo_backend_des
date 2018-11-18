 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Historial')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
  <div class="col-12">
    <div class="tile">
      <div class="col mb-3 text-center ">
          <form class="row d-flex justify-content-end" method="get" action="{{ route('caja.historial') }}">
            <div class="form-group col-md-2 mr-1 p-0">
              <input type="date" class="form-control" name="fecha">
            </div>
            <div class="form-group col-md-2 mr-1 p-0">
              <input type="text" class="form-control" name="venta" placeholder="N° Venta">
            </div>
            <div class="form-group col-md-2 mr-1 p-0">
              <input type="text" class="form-control" name="referencia" placeholder="Referencia">
            </div>
            <div class="form-group col-md-2 mr-1 p-0">
              <select class="form-control" id="" name="usuario">
                <option value="" selected disabled>Usuario</option>
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-1 p-0 mr-1">
              <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
          </form>
        </div>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead class="text-center">
                <tr> 
                  <th>Fecha</th>
                  <th>N° Venta</th>
                  <th>Importe</th>
                  <th>Usuario</th>
                  <th>Tipo de ingreso</th>
                  <th>Referencia</th>
                </tr>
              </thead>
              <tbody class="text-center">                
                @foreach ($detalles as $detalle)
                 <tr>
                    <td>{{ $detalle->fecha }}</td>
                    <td>{{ $detalle->id_venta }}</td>
                    <td>{!!number_format($detalle->importe, 0, ',', '.')!!}</td>
                    <td>{{ $detalle->nombre_usuario }}</td>
                    <td>{{ $detalle->tipo_movimiento }}</td>
                    <td>{{ $detalle->referencia_detalle }}</td>
                 </tr>
                @endforeach
              </tbody>             
            </table>
            {{ $detalles->appends( Request::only(['fecha','referencia','usuario','venta']) )->links() }}
          </div>
        </div>
    </div>
  </div>
</div> 

@endsection

@push('scripts')
  
@endpush