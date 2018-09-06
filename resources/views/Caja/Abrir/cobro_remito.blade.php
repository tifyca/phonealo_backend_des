<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cobro de Remitos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('caja/remitos'))
@section('display_new','d-none')  @section('link_new',  '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12 col-md-7">
    <div class="tile">
       <h3 class="tile-title text-center text-md-left">Ventas </h3>
        <div class="tile-body">
            <table class="table">
              <thead>
                <tr >
                  <th>N° Venta</th>
                  <th>Importe</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>13765</td>
                  <td>123456</td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-primary open_modal" href="" ><i class="fa m-0 fa-edit"  ></i></a>
                      <a class="btn btn-primary confirm-delete" href="" data-toggle="modal" data-target="#Confirmar"  data-placement="top" title="Confirmar"><i class="fa m-0 fa-check"></i></a> 
                      <a class="btn btn-primary confirm-delete" href="" ><i class="fa m-0 fa-times"></i></a>                   
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>13765</td>
                  <td>123456</td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-primary open_modal" href="" ><i class="fa m-0 fa-edit"  ></i></a>
                      <a class="btn btn-primary confirm-delete" href="" data-toggle="modal" data-target="#Confirmar"  data-placement="top" title="Confirmar"><i class="fa m-0 fa-check"></i></a> 
                      <a class="btn btn-primary confirm-delete" href="" ><i class="fa m-0 fa-times"></i></a>                   
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>13765</td>
                  <td>123456</td>
                  <td></td>
                </tr>
                

              </tbody>
            </table>
        </div>
    </div>
  </div>
   <div class="col-12 col-md-5">
    <div class="tile">
       <div class="d-flex justify-content-between mb-3">
          <h3 class=" text-left">Resumen</h3>
          <b class="mt-2 text-right">Delivery: Hector Cuellar</b>
        </div>
        <div class="tile-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Total efectivo</th>
                  <td>40000</td>
                </tr>
                <tr>
                  <th>Total Pos</th>
                  <td>60000</td>
                </tr>
                <tr>
                  <th>Total otros</th>
                  <td>09876</td>
                </tr>
              </tbody>
            </table>
            
            <div class="col-12 text-center pt-4">
              <a href="{{ route('caja.abrir') }}" class="btn btn-primary" title="">Confirmar Remito</a>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  py-5">
        <div class="col-12 d-flex justify-content-around">
          <button type="button" class="btn btn-primary col-2" data-dismiss="modal">Efectivo</button>
          
        </div>
        <div class="col-12 mt-4">
          <div class="row d-flex justify-content-center">
            <input type="text" class="form-control col-8" name="" placeholder="Nombre">
            <button type="button" class="btn btn-primary col-2" data-dismiss="modal">Otros</button>
          </div>
        </div>
        <div class="col-12 mt-4">
          <div class="row d-flex justify-content-center">
            <input type="text" class="form-control col-8" name="" placeholder="Referencia">
            <button type="button" class="btn btn-primary col-2" data-dismiss="modal">POS</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush