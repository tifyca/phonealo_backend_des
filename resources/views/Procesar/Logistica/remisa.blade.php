<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Remisa')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('procesar/logistica'))
@section('display_new','d-none')  @section('link_edit', '')
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
          <!--<form id="frmc" name="frmc"  novalidate="">-->
            {{ csrf_field() }} 
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
            <div class="row">
             
              <div class="form-group col-6">
                <label class="control-label">Repartidores</label>
                <!-- REPARTIDORES-->
              <select class="form-control read" id="id_empleado" name="id_empleado">
                <option value="">Repartidor</option>
                  @foreach($repartidores as $repartidor)
                    <option value="{{$repartidor->id}}">{{$repartidor->nombres}}</option>
                  @endforeach
              </select>
              </div>
              <div class="tile-footer col-12 col-md-2 text-center border-0" >
                <button class="btn btn-primary btn-save"  target="_blank" id="btn-save"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>
              </div>
            </div>
          <!--</form>-->
        <div class="tile-body ">
        </div>  
    </div>
  </div>
  <div id="respAsignarRemisa">
    
  </div>

  
  <div class="col-12">
    <div class="tile">
      <div class="table-responsive">
              <table class="table table-hover table-bordered " id="ventas-list">
                <thead>
                  <tr>
                    <th>Venta</th>
                    <th>Forma Pago</th>
                    <th>Horario de Entrega</th>
                    <th>Producto</th>
                    <th style="text-align: center;">Cantidad</th>
                    <th style="text-align: center;">Importe</th>
                  </tr>
                </thead>
                <tbody>

                   <!-- jgonzalez LISTADO DE VENTAS ACTIVAS-->
                  <?php 
                    $total = 0;
                  ?>
                  @foreach($remisas as $remisa)
                   <tr>
                      <td>{{$remisa->id}}</td>
                      <td>{{$remisa->forma_pago}}</td>
                      <td>{{$remisa->horario}}</td>
                      <td>{{$remisa->descripcion}}</td>
                      <td style="text-align: center;">{{$remisa->cantidad}}</td>
                      <td style="text-align: right;">{!!number_format($remisa->importe, 0, ',', '.')!!}</td> 
                    </tr>
                    <?php 
                      $total += $remisa->importe;
                    ?>
                  @endforeach
                       
                </tbody>
              </table>
            <table style="text-align: right;" class="table table-hover table-bordered ">
              <tr >
                    <td colspan="9"  >
                      <h4>Total: {!!number_format($total, 0, ',', '.')!!} Gs.
                      </h4>
                    </td>
                  </tr>
            </table>
            </div>
                     <input type="hidden" id="total" name="total" value="{{$total}}">
    </div>
  </div>
</div>
  
      
     
     
     
    </div>
   </div>
  </div>

 </div>



@endsection

@push('scripts')

<script type="text/javascript">
  
  //<!-- Asignar Remisa -->
  $('#btn-save').click(function(){
    
    var id_empleado = $('#id_empleado').val();  //CAPTURA EL ID  
    var id_usuario = $('#id_usuario').val();  //CAPTURA EL ID
    var total = $('#total').val();
    var ventas = [];
    $("#ventas-list tbody tr").each(function () {
      
      ventas.push ($(this).find('td').eq(0).html());

      })
    //console.log(ventas);
    //console.log(id_empleado);
    //console.log(id_usuario);
   //console.log(total)
    $.ajax({
        type: "GET",
        url: '{{ url('asignar_remisa') }}',
        dataType: "json",
        data: { id_empleado:id_empleado,id_usuario:id_usuario,total:total, ventas:ventas, _token: '{{csrf_token()}}'},
        success: function (data){
          console.log(data.id);

            $("#res").html('La Venta fue  Remisada con Éxito');
            $("#res, #res-content").css("display","block");

            window.open(`{{ url('procesar/logistica?id_remisa=${data.id}')}} `);
           
            window.location.href = "../../procesar/logistica";
        
        }
    });  

    
  });





</script>
 

 
@endpush

