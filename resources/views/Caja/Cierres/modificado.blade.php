 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Modificado')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('caja/cierres/informe'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
  <div class="col-12 col-md-7">
    <div class="tile">

          <h5 class=" text-left">Venta N°: 098765</h5>
        <hr>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="2">Movimineto</th>
                  <th></th>
                  <th>Usuario</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">Importe total</td>
                  <td>$159.000</td>
                  <td>Usuario</td>
                  <td>00/00/0000</td>
                </tr>
                <tr>
                  <td colspan="2">Vendedor</td>
                  <td>celeste.perez</td>
                  <td>Usuario</td>
                  <td>00/00/0000</td>
                </tr>
                <tr>
                  <td colspan="2">Producto/s:</td>
                  <td>Reloj Smart 1</td>
                  <td>Usuario</td>
                  <td>00/00/0000</td>
                </tr>
                <tr>
                  <td colspan="2">Dirección</td>
                  <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</td>
                  <td>Usuario</td>
                  <td>00/00/0000</td>
                </tr>

              </tbody>
              <tbody style="border-top: 2px solid black">
                <tr class="table-danger">
                  <td colspan="2">Importe total</td>
                  <td>876543</td>
                  <td>Usuario</td>
                  <td>00/00/0000</td>
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