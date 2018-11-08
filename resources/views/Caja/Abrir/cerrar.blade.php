 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cerrar Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', route('caja.index'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
  <div class="col-12 col-md-7">
    <div class="tile">
        <div class="d-flex justify-content-between">
          <h5 class=" text-left">{{ auth()->user()->name }}</h5>
          <h5 class="text-right">{{ $fecha }}</h5>
        </div>
        <hr>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <tbody>
                <tr>
                  <th>Total ingresos efectivo</th>
                  <td> $ 1.000.000 </td>
                </tr>
                <tr>
                  <th>Total ingreso POS</th>
                  <td> $ 250.000 </td>
                </tr>
                <tr>
                  <th>Total ingreso Otros</th>
                  <td> $ 100.000 </td>
                </tr>
                <tr>
                  <th>Total Salidas</th>
                  <td> $ 295.000 </td>
                </tr>
                <tr>
                  <th>Total Gastos</th>
                  <td> $ 122.000 </td>
                </tr>
                <tr class="table-secondary">
                  <th class="text-right">NETO EFECTIVO EN CAJA</th>
                  <td><b>$ 583.000</b></td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="col-12">
            <form action="{{ route('caja.cerrarCaja') }}" method="post">
              {{ csrf_field() }}    
              <input type="hidden" name="id" value="{{ $caja->id }}">
              <textarea name="observaciones" class="form-control" rows="4" placeholder="Observaciones" required></textarea>
              <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary">Confirmar Cierre</button>
              </div>
              
            </form>
          </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush