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
          <div class="row d-flex justify-content-end">
            <div class="form-group col-md-2">
              <input type="date" class="form-control" name="">
            </div>
            <div class="form-group col-md-2">
              <input type="text" class="form-control" name="" placeholder="N° Venta">
            </div>
            <div class="form-group col-md-2">
              <input type="text" class="form-control" name="" placeholder="Referencia">
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Usuario</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
        </div>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead>
                <tr> 
                  <th>Fecha</th>
                  <th>N° Venta</th>
                  <th>Importe</th>
                  <th>Usuario</th>
                  <th>Tipo de ingreso</th>
                  <th>Referencia</th>
                </tr>
              </thead>
              <tbody>
                <tr> 
                  <td>Fecha</td>
                  <td>N° Venta</td>
                  <td>Importe</td>
                  <td>Usuario</td>
                  <td>Tipo de ingreso</td>
                  <td>Referencia</td>
                </tr>
                <tr> 
                  <td>Fecha</td>
                  <td>N° Venta</td>
                  <td>Importe</td>
                  <td>Usuario</td>
                  <td>Tipo de ingreso</td>
                  <td>Referencia</td>
                </tr>
                <tr> 
                  <td>Fecha</td>
                  <td>N° Venta</td>
                  <td>Importe</td>
                  <td>Usuario</td>
                  <td>Tipo de ingreso</td>
                  <td>Referencia</td>
                </tr>
                <tr> 
                  <td>Fecha</td>
                  <td>N° Venta</td>
                  <td>Importe</td>
                  <td>Usuario</td>
                  <td>Tipo de ingreso</td>
                  <td>Referencia</td>
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