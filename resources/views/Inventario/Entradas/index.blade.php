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

@if(Session::has('message'))
<div class="alert alert-success">

 {{ Session::get('message') }} 
</div>
@endif      

<input type="hidden" name="tipom" id="tipom" value="<?php echo $tipo ?>">
<input type="hidden" name="mensaje" id="mensaje" value="{{$mensaje}}">  

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <div class="col mb-3 text-center">
          <div class="row ">
            <div class="col">
              <h4 class="tile-title text-center text-md-left">Listado de Entradas</h4>
            </div>
            <form class="row d-flex justify-content-end" action="{{route('entradas.index')}}" method="get"> 
              <div class="form-group col-md-3">
                <select class="form-control" id="id_proveedor" name="id_proveedor">
                  <option value="">Proveedor</option>
                  @foreach($proveedores as $provee)
                  <option value="{{$provee->id}}">{{$provee->nombres}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-5">
                <input class="form-control" type="date" name="fecha" id="fecha">
              </div>
              <div class="col-md-1 mr-md-5">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              </div>
            </form>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover " id="sampleTable">
            <thead>
              <tr>
                <th>Id</th>
                <th>N° Doc.</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Estatus</th>
                <th class="text-center"> Monto</th>
                <th align="center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @php
              $total=0;
              @endphp
              @foreach($solped as $sol)
              <tr 
              @if($sol->id_estado==1) class="table-info" @endif 
              @if($sol->id_estado==7) class="table-success" @endif
              @if($sol->id_estado==10) class="table-danger" @endif
              >
              <td>{{$sol->id}}</td>
              <td>{{$sol->nro_documento}}</td>
              <td>{{$sol->fecha}}</td>
              <td>{{$sol->nombres}}</td>
              <td>@foreach($estados as $estado)
                @if($estado->id == $sol->id_estado)
                {{$estado->estado}}
                @endif
                @endforeach
              </td>
              <td class="text-right">
                <?php 
                $monto = number_format($sol->monto, 2, ',', '.');
                echo $monto;?>
              </td>
              <td>
               <div class="btn-group text-center">
                <a class="btn btn-primary" href="{{ route('entradas.ver',$sol->id) }}" title="Ver"><i class="m-0 fa fa-lg fa-eye"></i></a>
                @if($sol->id_estado==8)
                @endif
                @if($sol->id_estado==1) 
                 <a class="btn btn-primary" href="{{ route('entradas.confirmar',$sol->id) }}" title="Confirmar/Carga Inventario"><i class="m-0 fa fa-lg fa-check"></i></a>
                  <button data-toggle="tooltip" data-placement="top" title="Anular" class="btn btn-primary btn-sm confirm-delete" value="{{$sol->id}}"><i class="fa fa-lg fa-random"></i></button>                                  
               @endif 

              </div>

            </td>
            @php

            $total= $total + ($sol->monto);
            @endphp
            @endforeach
            <tr class="table-secondary">
              <td colspan="5" class="text-right"><b>Total Importe</b></td>
              <td  class="text-right"><b><?php 
              $ztotal = number_format($total, 2, ',', '.');
              echo $ztotal;?></b></td>
              <td></td>
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Anular Solicitud de Pedido</h4>
      </div>
      <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
        <div class="modal-body">
          <p>Está seguro que desea Anular esta Solicitud?</p>
          <p class="debug-url"></p>
        </div>
      </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
        <button type="button" class="btn btn-danger delete-solicitud" >Si</button>
        <input type="hidden" id="solicitud-id" name="solicitud-id" value="0">
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script type="text/javascript" language="javascript">
window.onload = load;
function load(){
  var valor  = $("#tipom").val();
  var mensaje = $("#mensaje").val();
  
  if(valor==1){

           $("#res").html(mensaje);
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
  }
  if(valor==2){

            $("#rese").html(mensaje);
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
  }

} 


  $ = jQuery;
  jQuery(document).ready(function () {


    $("input#boton").bind('click', function (event) {
      $("form").submit();
    });
    
  });


// muestra modal para la confirmar eliminar   categoria
$(document).on('click', '.confirm-delete', function () {
    var id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#solicitud-id').val(id);
});



$(document).on('click', '.delete-solicitud', function () {

    var id = $('#solicitud-id').val();
    var valor = id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
        $.ajax({
          type: "GET",
          url: '{{ route('entradas.anular') }}',
          dataType: "json",
          data: { id: valor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
            $('#confirm-delete').modal('hide');
            $("#res").html("Solicitud Anulada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
          },    
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo anular la solicitud");
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }

        });


});


</script>
  @endpush




































