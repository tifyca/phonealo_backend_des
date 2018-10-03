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
                <button class="btn btn-primary btn-save"  id="btn-save"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>
              </div>
            </div>
          <!--</form>-->
        <div class="tile-body ">
        </div>  
    </div>
  </div>

  
  <div class="col-12">
    <div class="tile">
      <div class="table-responsive">
              <table class="table table-hover table-bordered " id="ventas-list">
                <thead>
                  <tr>
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Fecha Activo</th>
                    <th>Ciudad</th>
                    <th>Horario</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
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
                      <td>{{$remisa->nombres}}</td>
                      <td>{{$remisa->telefono}}</td>
                      <td>{{$remisa->direccion}}</td>
                      <td>{{$remisa->fecha}}</td>
                      <td>{{$remisa->fecha_activo}}</td>
                      <td>{{$remisa->ciudad}}</td>
                      <td>{{$remisa->horario}}</td>
                      <td>{{$remisa->forma_pago}}</td>
                      <td>{{$remisa->importe}}</td>
                    </tr>
                    <?php 
                      $total += $remisa->importe;
                    ?>
                  @endforeach
                       
                </tbody>
              </table>
            <table>
              <tr>
                    <td colspan="9" class="text-left">
                      <h4>Total:</h4>
                    </td>
                    <td colspan="1">
                      <h4>
                        {{ $total }}
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
    console.log(ventas);
    console.log(id_empleado);
    console.log(id_usuario);
    console.log(total)
    $.ajax({
        type: "GET",
        url: '{{ url('asignar_remisa') }}',
        dataType: "json",
        data: { id_empleado:id_empleado,id_usuario:id_usuario,total:total, ventas:ventas, _token: '{{csrf_token()}}'},
        success: function (data){
          
             $('#respAsignarRemisa').html('Confirmado');  

        location.href="procesar/logistica"   
        }
    });  

    
  });





</script>
 

 
@endpush

