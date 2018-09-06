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
                  <th>Remitos en Delivery</th>
                  <th>Delivery</th>
                  <th>Importe total</th>
                  <th>Fecha</th>
                  <th>Cobrar</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>13001</td>
                  <td>Hector Cuellar</td>
                  <td>100000</td>
                  <td>27/8/18</td>
                  <td><a href="{{ route('caja.cobro_remito') }}" class="btn btn-primary confirm-delete"><i class="fa m-0 fa-money"></i></a></td>
                </tr>
                <tr>
                  <td>13002</td>
                  <td>Victor Almiron</td>
                  <td>134000</td>
                  <td>27/8/18</td>
                  <td><a href="{{ route('caja.cobro_remito') }}" class="btn btn-primary confirm-delete"><i class="fa m-0 fa-money"></i></a></td>
                </tr>
                <tr>
                  <td>13003</td>
                  <td>Horacio Cuellar</td>
                  <td>300000</td>
                  <td>27/8/18</td>
                  <td><a href="{{ route('caja.cobro_remito') }}" class="btn btn-primary confirm-delete"><i class="fa m-0 fa-money"></i></a></td>
                </tr>
                <tr>
                  <td>13004</td>
                  <td>David Gauto</td>
                  <td>280000</td>
                  <td>27/8/18</td>
                  <td><a href="{{ route('caja.cobro_remito') }}" class="btn btn-primary confirm-delete"><i class="fa m-0 fa-money"></i></a></td>
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