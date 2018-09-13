@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Entradas')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('inventario/entradas/show') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="row">
        <div class="col">
          <h3 class="tile-title text-center text-md-left">Listado de Entradas</h3>
        </div>
        <div class="form-group col-md-2">
          <select class="form-control" id="id_proveedor" name="id_proveedor">
            <option value="">Proveedor</option>
            @foreach($proveedores as $provee)
            <option value="{{$provee->id}}">{{$provee->nombres}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-2">
          <input class="form-control" type="date" name="">
        </div>
      </div>
      <div class="tile-body ">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered " id="sampleTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>N° Doc.</th>
                  <th>Fecha</th>
                  <th>Proveedor</th>
                  <th>Estatus</th>
                  <th>Monto</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody>
                @php
                $total=0;
                @endphp
                @foreach($solped as $sol)
                <tr>
                  <td>{{$sol->id}}</td>
                  <td>{{$sol->nro_documento}}</td>
                  <td>{{$sol->fecha}}</td>
                  <td>{{$sol->nombres}}</td>
                  <td>{{$sol->id_estado}}</td>
                  <td>
                    <?php 
                    $monto = number_format($sol->monto, 2, ',', '.');
                    echo $monto;?>
                  </td>
                  @php

                  $total= $total + ($sol->monto);
                  @endphp
                  @endforeach
                  <tr class="table-secondary">
                    <td colspan="5" class="text-right"><b>Total Importe</b></td>
                    <td colspan="2"><b><?php 
                    $ztotal = number_format($total, 2, ',', '.');
                    echo $ztotal;?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
              <?php echo $solped->render(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

  @endsection

  @push('scripts')
  
  @endpush