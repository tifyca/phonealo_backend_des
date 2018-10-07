@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', ' Gastos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/gastos/show')) 
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
      <div class="col mb-2 text-center">
        <div class="col">
              <h4 class="tile-title text-center text-md-left">Listado de Gastos</h4>
            </div>
          <div class="row">
            
               <form class="row" action="{{route('gastos.index')}}" method="get"> 
              <div class="form-group col-md-2">
              <select class="form-control" id="id_categoria" name="id_categoria" ">
                <option value="">Categoría</option>
                @foreach($categorias as $cate)
                <option value="{{$cate->id}}">{{$cate->categoria}}</option>
                @endforeach
              </select>
            </div>
              <div class="form-group col-md-3">
              <select class="form-control" id="id_proveedor" name="id_proveedor" ">
                <option value="">Proveedor</option>
                @foreach($proveedores as $proveedor)
                <option value="{{$proveedor->id}}">{{$proveedor->nombres}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-2">
              <select class="form-control" id="id_usuario" name="id_usuario">
                <option value="">Usuario</option>
                @foreach($usuarios as $us)
                <option value="{{$us->id}}">{{$us->name}}</option>
                @endforeach                
              </select>
            </div>
          <div class="form-group col-md-2">
              <input type="date" class="form-control" name="desde" id='desde'>
            </div>
            <div class="form-group col-md-2">
              <input type="date" class="form-control" name="hasta" id='hasta'>
            </div>            
            <div class="form-group col-md-1">
              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              
            </div>
            </form>
     
          </div>
        </div>
        <div class="tile-body ">
          <div class="table-responsive">
              <table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th>Categoría</th>
                    <th>Comprobante</th>
                    
                    <th>Proveedor</th>
                    <th>Fuente</th>
                    <th class="text-center">Importe</th>
                    <th align="center">Fecha de Comprobante</th>
                    <th align="center">Fecha de Carga</th>
                    <th align="center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($gastos as $gast)
                  <tr
                    @if($gast->id_estado=="2")
                    class="table-danger"
                    @endif
                  >
                    <td>
                       @foreach($categorias as $categoria)
                       @if($categoria->id==$gast->id_categoria)
                         {{$categoria->categoria}}
                      @endif
                     @endforeach
                    </td>
                    <td>{{$gast->comprobante}}</td>
                   
                    <td>
                      @foreach($proveedores as $proveedor)
                       @if($proveedor->id==$gast->id_proveedor)
                          {{$proveedor->nombres}}
                       @endif
                      @endforeach
                    </td>
                    <td>@foreach($fuentes as $fuen)
                        @if($fuen->id==$gast->id_fuente)
                            {{$fuen->fuente}}
                        @endif
                      @endforeach
                    </td>
                    <td class="text-right">
                    <?php 
                    $monto = number_format($gast->importe, 0, ',', '.');
                    echo $monto;?>

                    </td>
                    <td  class="text-center">{{$gast->fecha_comprobante}}</td>
                    <td  class="text-center">{{$gast->fecha}}</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                       @if($gast->id_estado!=2)  
                        <a class="btn btn-primary" href="{{ route('gastos.edit',$gast->id) }}"><i class="fa fa-lg fa-eye"></i></a>
                         @if($gast->id_categoria!=2)
                          <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$gast->id}}"><i class="fa fa-lg fa-trash"></i></button>  
                         @endif 
                        @endif    
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
             <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    {{$gastos->appends(Request::only(['id_categoria' , 'id_usuario', 'desde','hasta','id_proveedor']))->links()}}
              </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Anular Gastos</h4>
      </div>
      <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
        <div class="modal-body">
          <p>Está seguro que desea Anular el Gasto?</p>
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
          url: '{{ route('gastos.anular') }}',
          dataType: "json",
          data: { id: valor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
            $('#confirm-delete').modal('hide');
            $("#res").html("Gasto Anulado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
          },    
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo anular el gasto");
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }

        });


});


</script>
  @endpush