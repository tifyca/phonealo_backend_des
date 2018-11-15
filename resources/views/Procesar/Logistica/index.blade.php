<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Logística')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')
@section('btn')
<a class="btn btn-primary " href="#collapseExample" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="m-0 fa fa-lg fa-calendar"></i></a>
<a class="btn btn-primary " href="#collapseExample2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample2"><i class="m-0 fa fa-lg fa-search"></i></a>
@endsection

@section('content')
@php $longitud=count($notaventa); @endphp

@if($mensaje!==0)
  <div class="alert-top fixed-top col-6 offset-md-4  " >
     <div  class="col-12  text-center alert alert-info" >{{$mensaje}} </div>  
  </div>
@endif
{{-- HORARIOS --}}
<div class="collapse" id="collapseExample">
<div class="row " >
  <div class="col-md-3" >
  <form id="form1" name="form1" action="{{ route('logistica.submit') }} " method="POST">
      <input type="hidden" name="id_horario" id="id_horario" value=""/>
      {{ csrf_field() }} 
      <div @if($class==1 && $id_horario==1) 
              class="widget-small info coloured-icon" 
              @else  
              class="widget-small primary coloured-icon"
              @endif ><i class="icon fa fa-clock-o"  onClick="SetToHidden('1');" style="cursor:pointer;"></i>
        <div class="info" >
          <h4>Mañana</h4>
          <div class="onoffswitch">
            <input type="checkbox" name="h1" class="onoffswitch-checkbox horario" value="1" id="h1" @if($totalhorario[0]->status_v==1) checked @else ''@endif>
              <label class="onoffswitch-label" for="h1">
               <span class="onoffswitch-inner"></span>
               <span class="onoffswitch-switch"></span>
              </label>
         </div>
          @if($totalhorario[0]->id==1)
          <p><b>Total: {!!number_format($totalhorario[0]->total, 0, ',', '.')!!} </b></p>
          @endif
        </div>
      </div>
    </div>
        
 
        <div class="col-md-3">
          <div @if($class==1 && $id_horario==2) 
              class="widget-small info coloured-icon" 
              @else  
              class="widget-small primary coloured-icon"
              @endif
              ><i class="icon fa fa-clock-o"  onClick="SetToHidden('2');" style="cursor:pointer;"></i>
            <div class="info">
              <h4>Tarde </h4>
            <div class="onoffswitch">
            <input type="checkbox" name="h2" class="onoffswitch-checkbox horario" id="h2" value="2" @if($totalhorario[1]->status_v==1) checked @else '' @endif>
              <label class="onoffswitch-label" for="h2">
               <span class="onoffswitch-inner"></span>
               <span class="onoffswitch-switch"></span>
              </label>
         </div>
            @if($totalhorario[1]->id==2)
              <p><b>Total: {!!number_format($totalhorario[1]->total, 0, ',', '.')!!} </b></p>
            @endif
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div @if($class==1 && $id_horario==3) 
              class="widget-small info coloured-icon" 
              @else  
              class="widget-small primary coloured-icon"
              @endif><i class="icon fa fa-clock-o"  onClick="SetToHidden('3');" style="cursor:pointer;"></i>
            <div class="info">
              <h4>Todo el día </h4>
              <div class="onoffswitch">
            <input type="checkbox" name="h3" class="onoffswitch-checkbox horario" id="h3" value="3" @if($totalhorario[2]->status_v==1) checked @else '' @endif>
              <label class="onoffswitch-label" for="h3">
               <span class="onoffswitch-inner"></span>
               <span class="onoffswitch-switch"></span>
              </label>
         </div>
               @if($totalhorario[2]->id==3)
              <p><b>Total: {!!number_format($totalhorario[2]->total, 0, ',', '.')!!}</b></p>
              @endif
            </div>
          </div>
        </div>
      <div class="col-md-3">
      <div @if($class==1 && $id_horario==4) 
              class="widget-small info coloured-icon" 
              @else  
              class="widget-small primary coloured-icon"
              @endif><i class="icon fa fa-clock-o"  onClick="SetToHidden('4');" style="cursor:pointer;"></i>
        <div class="info">
          <h4>09:00-12:00 </h4>
          <div class="onoffswitch">
            <input type="checkbox" name="h4" class="onoffswitch-checkbox horario" id="h4" value="4" @if($totalhorario[3]->status_v==1) checked @else '' @endif>
              <label class="onoffswitch-label" for="h4">
               <span class="onoffswitch-inner"></span>
               <span class="onoffswitch-switch"></span>
              </label>
         </div>
          @if($totalhorario[3]->id==4)
          <p><b>Total: {!!number_format($totalhorario[3]->total, 0, ',', '.')!!}</b></p>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-3">
          <div @if($class==1 && $id_horario==5) 
              class="widget-small info coloured-icon" 
              @else  
              class="widget-small primary coloured-icon"
              @endif><i class="icon fa fa-clock-o"  onClick="SetToHidden('5');" style="cursor:pointer;"></i>
            <div class="info">
              <h4>12:00-15:00</h4>
               <div class="onoffswitch">
            <input type="checkbox" name="h5" class="onoffswitch-checkbox horario" id="h5" value="5" @if($totalhorario[4]->status_v==1) checked @else '' @endif>
              <label class="onoffswitch-label" for="h5">
               <span class="onoffswitch-inner"></span>
               <span class="onoffswitch-switch"></span>
              </label>
         </div>
               @if($totalhorario[4]->id==5)
              <p><b>Total: {!!number_format($totalhorario[4]->total, 0, ',', '.')!!}</b></p>
               @endif
            </div>
          </div>
        </div>
      <div class="col-md-3">
          <div @if($class==1 && $id_horario==6) 
              class="widget-small info coloured-icon" 
              @else  
              class="widget-small primary coloured-icon"
              @endif><i class="icon fa fa-clock-o"  onClick="SetToHidden('6');" style="cursor:pointer;"></i>
            <div class="info">
              <h4>15:00-18:00</h4>
                <div class="onoffswitch">
            <input type="checkbox" name="h6" class="onoffswitch-checkbox horario" id="h6" value="6" @if($totalhorario[5]->status_v==1) checked @else '' @endif>
              <label class="onoffswitch-label" for="h6">
               <span class="onoffswitch-inner"></span>
               <span class="onoffswitch-switch"></span>
              </label>
         </div>
              @if($totalhorario[5]->id==6)
              <p><b>Total: {!!number_format($totalhorario[5]->total, 0, ',', '.')!!}</b></p>
                @endif
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div @if($class==1 && $id_horario==7) 
              class="widget-small info coloured-icon" 
              @else  
              class="widget-small primary coloured-icon"
              @endif><i class="icon fa fa-clock-o"  onClick="SetToHidden('7');" style="cursor:pointer;"></i>
            <div class="info">
              <h4>18:00-21:00</h4>
              <div class="onoffswitch">
                <input type="checkbox" name="h7" class="onoffswitch-checkbox horario" id="h7" value="7" @if($totalhorario[6]->status_v==1) checked @else '' @endif>
                  <label class="onoffswitch-label" for="h7">
                   <span class="onoffswitch-inner"></span>
                   <span class="onoffswitch-switch"></span>
                  </label>
         </div>
          @if($totalhorario[6]->id==7)
              <p><b>Total: {!!number_format($totalhorario[6]->total, 0, ',', '.')!!}</b></p>
                @endif
            </div>
          </div>
        </div>
       </form>
        <div class="col-md-3">
          <div class="widget-small danger"><i class="icon fa fa-exclamation-circle fa-3x"></i>
            <div class="info">
              <h4>Karma</h4>
               <h3><b>Total: {{ $karma }}</b></h3>
            </div>
          </div>
        </div>
    </div>
</div>
{{-- FIN HORARIOS --}}

{{--  BUSCARDOR--}}
<div class="col-12 collapse" id="collapseExample2">
  <!--Formulario para filtros -->
      <form class="" action="{{ route('logistica.submit') }} " method="POST" >
        {{ csrf_field() }}
        
          <div class="row ">  
            <!--form class="row d-flex justify-content-end" action="{{route('cargos.index')}}" method="get"-->
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Búsqueda</h3>
            </div>
             <div class="form-group col-md-6 ">
                         @if($class==1 && $busca!==0) 
                          
                           <input  type="text"style="border-color:#3056bf"   class="form-control" name="buscador" id="buscador" value="{{ $busca}}"   maxlength="50">

                          @else  
                                      
                            <input  type="text" style="border-color:''"  class="form-control" name="buscador" id="buscador"  value="" maxlength="50">
                          @endif 
            </div>
           
            <div class="form-group  col-md-4">
              <button  id="btnBuscar" @if($class==1 && $busca!==0) 
                                      class="btn btn-info" 
                                      @else  
                                      class="btn btn-primary"
                                      @endif >Filtrar</button> 
              <button  id="reset"  class="btn btn-primary reset">Limpiar</button> 
            </div>
        
        </div>
 
        </form>
        <!---->
</div>
{{-- FIN BUSCADOR--}}

{{-- REMISA --}}
<div class="task-board  ">
    <div class="status-card">
        <div class="card-header">
            <span class="card-header-text">Ventas</span>
        </div>
        
        <ul class="sortable ui-sortable "  id="empleado0" data-empleado-id="0">
          {{--  @include('Logistica.remisa.ventas6')  --}}
           
        </ul>
    </div>
    
    @foreach ($empleados as $empleado)
        <div class="status-card" id="card_delivery">
            <div class="card-header">
                <span class="card-header-text">{{ $empleado->nombres }}</span>
            </div>
            
            <ul class="sortable ui-sortable emple empleado{{ $empleado->id }}" id="empleado{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}">
                @foreach ($remisa as $item)
                   @if ($item->id_delivery == $empleado->id)
                       @foreach ($ventasAsignadas as $ventaA)
                            @if ($ventaA->id == $item->id_venta)
                                <li style="@if ($ventaA->id_estado == 7) background: silver; @endif" class="text-row li{{ $ventaA->id }} ui-sortable-handle" data-importe='{{ $ventaA->importe }}' data-venta-id="{{ $ventaA->id }}">{{ $ventaA->id }}---{{ $ventaA->importe }}
                                    
                                </li>
                            @endif
                       @endforeach
                   @endif
                @endforeach
            </ul>
            <div class="col-12 text-right mb-3">
                <p><b>Total: <span class="total" id="total{{ $empleado->id }}">0</span> Gs.</b></p>
                <button type="button" id="btnSaveRemito{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}" class="btn btn-primary ">Confirmar</button>
            </div>
        </div>
    @endforeach  

</div> 
{{-- FIN REMISA --}}

{{-- TABLA POR ATENDER --}}
{{-- ESTA TABLA SOLO APARECE CUANDO HAY VENTAS POR ATENDER --}}
@if(count($xatender) > 0)
<div class="col-12" >
<div class="tile ">
  <h3 class="tile-title text-center text-md-left"> Ventas por Atender </h3>
  <div class="tile-body ">
    <div class="table-responsive">
          <table class="table table-hover table-bordered " id="xatender-list">
            <thead>
              <tr>
                <th style="text-align: center;">Venta</th>
                <th style="text-align: center">Cliente</th>
                <th style="text-align: center">Teléfono</th>
                <th style="text-align: center">Dirección</th>
                <th style="text-align: center">Fecha</th>
                <th style="text-align: center">Fecha Activo</th>
                <th style="text-align: center">Ciudad</th>
                <th style="text-align: center">Horario</th>
                <th style="text-align: center">Forma Pago</th>
                <th style="text-align: center">Importe</th>
                <th style="text-align: center">Acciones</th>
              </tr>
            </thead>
            <tbody>

              <!-- jgonzalez LISTADO DE VENTAS EN ATENDER-->
              
              @foreach($xatender as $atender)
               <tr
                 @if($atender->fecha == date("Y-m-d"))
                  class="table-danger"
                 @elseif($atender->fecha != date("Y-m-d"))
                  style="background-color:#f1d4fa;"
                 @endif>
                    <td class="venta" <?php $x=0; ?>
                                      @for($i=0; $i<$longitud; $i++)
                                        @if($atender->id==$notaventa[$i]->id_venta)
                                           <?php $x=$x+1; ?>
                                              @if($x==1)
                                                 data-id="{{$atender->id}}"
                                              @endif
                                        @endif
                                      @endfor  style="text-align: center;">{{$atender->id}}    
                                 <?php $x=0; ?>
                              @for($i=0; $i<$longitud; $i++)
                                @if($atender->id==$notaventa[$i]->id_venta)
                                 <?php $x=$x+1; ?>
                                 @if($x==1)
                                   &spades;
                                 @endif
                                @endif
                              @endfor
                              <div class="toolTip" id="{{$atender->id}}"  style="display: none;">
                          @foreach($nota as $item)
                            @if($item->id_venta==$atender->id)
                               <table style="border:0px; width: 850px; font-size: 12px; ">
                                <td style="border:0px; text-align: left; width: 140px;">{{$item->fecha}}</td>
                                <td style="border:0px; text-align: left; width: 110px;">{{$item->nombre}}</td>
                                <td style="border:0px; text-align: left;">{{$item->nota}}</td>
                               </table>
                            @endif
                          @endforeach
                              </div>
                          </td>
                 
                  </td>
                  <td style="text-align: left;">{{$atender->nombres}}</td>
                  <td style="text-align: center">{{$atender->telefono}}</td>
                  <td style="text-align: left;">{{$atender->direccion}}</td>
                  <td style="text-align: center">{{$atender->fecha}}</td>
                  <td style="text-align: center">{{$atender->fecha_activo}}</td>
                  <td style="text-align: left;">{{$atender->ciudad}}</td>
                  <td style="text-align: center">{{$atender->horario}}</td>
                  <td style="text-align: center">{{$atender->forma_pago}}</td>
                  <td style="text-align: center">{!!number_format($atender->importe, 0, ',', '.')!!}</td>
                  <td width="10%" class="text-center">
                    <div class="btn-group">
                     
                    <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $atender->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>

                     <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $atender->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>

                      <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary remisa"  value="{{ $atender->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                      <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="logistica/Ventas/editar/{{$atender->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                      <button data-toggle="tooltip" data-placement="top"  title="Nota" class="btn btn-primary nota"  value="{{$atender->id}}"><i class="fa fa-lg fa-comment-o" ></i></button>
                     </div>
                  </td>
                </tr>
                
              @endforeach

            </tbody>
          </table>
        </div>
  </div>
</div>
</div>
@endif
{{-- FIN TABLA POR ATENDER --}}

{{--LISTADO ACTIVO  --}}
<div class="col-12">
<div class="tile">
  <div class="col mb-3 text-center">
      <div class="row">
        <div class="col">
          <h3 class="tile-title text-center text-md-left">Listado</h3>
        </div>
      </div>
    </div>
    <div class="tile-body ">
      <div class="tile-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered " id="activas-list">
            <thead>
              <tr>
                <th style="text-align: center">Venta</th>
                <th style="text-align: center">Cliente</th>
                <th style="text-align: center">Teléfono</th>
                <th style="text-align: center">Dirección</th>
                <th style="text-align: center">Fecha</th>
                <th style="text-align: center">Fecha Activo</th>
                <th style="text-align: center">Ciudad</th>
                <th style="text-align: center">Horario</th>
                <th style="text-align: center">Forma Pago</th>
                <th style="text-align: center">Importe</th>
                <th style="text-align: center">Acciones</th>
              </tr>
            </thead>
            <tbody id="ventaActiva">
              <!-- jgonzalez LISTADO DE VENTAS ACTIVAS-->
              <?php 
                $total = 0;
              ?>

              
              @foreach($activas as $activa)
               <tr 
               @if($activa->id_estado == '1')
                  class="table-active"
                @elseif($activa->id_estado == '11')
                  class="table-warning"
                 @elseif($activa->id_estado == '7')
                  style="background-color:#F5CBA7;"
                @endif 
               >
                  <td class="venta" <?php $x=0; ?>
                                      @for($i=0; $i<$longitud; $i++)
                                        @if($activa->id==$notaventa[$i]->id_venta)
                                           <?php $x=$x+1; ?>
                                              @if($x==1)
                                                 data-id="{{$activa->id}}"
                                              @endif
                                        @endif
                                      @endfor  style="text-align: center;">{{$activa->id}}    
                                 <?php $x=0; ?>
                              @for($i=0; $i<$longitud; $i++)
                                @if($activa->id==$notaventa[$i]->id_venta)
                                 <?php $x=$x+1; ?>
                                 @if($x==1)
                                   &spades;
                                 @endif
                                @endif
                              @endfor
                                           
                              <div class="toolTip" id="{{$activa->id}}" style="display: none;">
                          @foreach($nota as $item)
                            @if($item->id_venta==$activa->id)
                                <table style="border:0px; width: 850px; font-size: 12px; ">
                                    <td style="border:0px; text-align: left; width: 140px;">{{$item->fecha}}</td>
                                    <td style="border:0px; text-align: left; width: 110px;">{{$item->nombre}}</td>
                                    <td style="border:0px; text-align: left;">{{$item->nota}}</td>
                               </table>
                            @endif
                          @endforeach
                              </div>
                          </td>
                  </td>
                  <td style="text-align: left;">{{$activa->nombres}}</td>
                  <td style="text-align: center">{{$activa->telefono}}</td>
                  <td style="text-align: left;">{{$activa->direccion}}</td>
                  <td style="text-align: center">{{$activa->fecha}}</td>
                  <td style="text-align: center">{{$activa->fecha_activo}}</td>
                  <td style="text-align: left;">{{$activa->ciudad}}</td>
                  <td style="text-align: center">{{$activa->horario}}</td>
                  <td style="text-align: center">{{$activa->forma_pago}}</td>
                  <td style="text-align: center">{!!number_format($activa->importe, 0,',', '.')!!}</td>
                  <td width="10%" class="text-center">
                    <div class="btn-group">
                     
                    <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>


                    @if($activa->id_estado == '7')

                     <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $activa->id }}" disabled><i class="m-0 fa fa-lg fa-print"></i></button>
  
                    <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary remisa"  value="{{ $activa->id }}" disabled><i class="m-0 fa fa-lg fa-plus" ></i></button>

                    <button data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary"  href="logistica/Ventas/editar/{{$activa->id}}"  disabled><i class="m-0 fa fa-lg fa-pencil"></i></button>

                    @else

                     <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-print"></i></button>
            
                    <!--<a class="btn btn-primary"  href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>-->
                    <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary remisa"  value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>

                    <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="logistica/Ventas/editar/{{$activa->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                    @endif
                    <button data-toggle="tooltip" data-placement="top"  title="Nota" class="btn btn-primary nota"  value="{{$activa->id}}"><i class="fa fa-lg fa-comment-o" ></i></button>
                    </div>
                  </td>
                </tr>
                <?php 
                  $total += $activa->importe;
                ?>
              @endforeach
                <tr>
                <td colspan="9" class="text-right">
                  <h4>Total:</h4>
                </td>
                <td colspan="2">
                  <h4>
                    {!!number_format($total, 0,',', '.')!!}
                  </h4>
                </td>
              </tr>
             
            </tbody>
          </table>

        </div>
        </div>
    </div>
</div>
</div>
{{-- FIN LISTADO ACTIVO --}}

{{-- TABLA EN ESPERA --}}
{{-- ESTA TABLA SOLO APARECE CUANDO HAY VENTAS EN ESPERA --}}
@if(count($enEsperas) > 0)
 <div class="col-12" >
  <div class="tile ">
    <h3 class="tile-title text-center text-md-left"> Ventas en Espera </h3> 
     <div align="right"><button class="btn btn-primary"  id="btn-activar" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Activar</button></div>
    <div class="tile-body ">
      <div class="table-responsive">
            <table class="table table-hover table-bordered " id="esperas-list">
              <thead>
                <tr>
                  <th style="text-align: center;">Venta</th>
                  <th style="text-align: center;">Cliente</th>
                  <th style="text-align: center;">Teléfono</th>
                  <th style="text-align: center;">Dirección</th>
                  <th style="text-align: center">Fecha</th>
                  <th style="text-align: center;">Fecha Activo</th>
                  <th style="text-align: center;">Ciudad</th>
                  <th style="text-align: center;">Horario</th>
                  <th style="text-align: center;">Forma Pago</th>
                  <th style="text-align: center;">Importe</th>
                  <th style="text-align: center;">Acciones</th>
                </tr>
              </thead>
              <tbody>

                <!-- jgonzalez LISTADO DE VENTAS EN ESPERA-->
                
                @foreach($enEsperas as $enEspera)
                 <tr 
                  @if($enEspera->id_estado == '5')
                    class="table-info"
                  @elseif($enEspera->id_estado == '12')
                    class="table-light"
                  @endif 
                  >
                    <td class="venta" <?php $x=0; ?>
                                        @for($i=0; $i<$longitud; $i++)
                                          @if($enEspera->id==$notaventa[$i]->id_venta)
                                             <?php $x=$x+1; ?>
                                                @if($x==1)
                                                   data-id="{{$enEspera->id}}"
                                                @endif
                                          @endif
                                        @endfor  style="text-align: center; width:15%">{{$enEspera->id}}    
                        <?php $x=0; ?>
                          @for($i=0; $i<$longitud; $i++)
                                 @if($enEspera->id==$notaventa[$i]->id_venta)
                              <?php $x=$x+1; ?>
                               @if($x==1)
                                 &spades;
                               @endif
                              @endif
                        @endfor

                                <div class="toolTip" id="{{$enEspera->id}}" style="display: none;">
                          @foreach($nota as $item)
                            @if($item->id_venta==$enEspera->id)
                                 <table style="border:0px; width: 850px; font-size: 12px; ">
                                  <td style="border:0px; text-align: left; width: 140px;">{{$item->fecha}}</td>
                                  <td style="border:0px; text-align: left; width: 110px;">{{$item->nombre}}</td>
                                  <td style="border:0px; text-align: left;">{{$item->nota}}</td>
                                 </table>
                            @endif
                          @endforeach
                                </div>
                      </td>
                    </td>
                    <td style="text-align: left;">{{$enEspera->nombres}}</td>
                    <td style="text-align: center">{{$enEspera->telefono}}</td>
                    <td style="text-align: left;">{{$enEspera->direccion}}</td>
                    <td style="text-align: center">{{$enEspera->fecha}}</td>
                    <td style="text-align: center">{{$enEspera->fecha_activo}}</td>
                    <td style="text-align: left;">{{$enEspera->ciudad}}</td>
                    <td style="text-align: center">{{$enEspera->horario}}</td>
                    <td style="text-align: center">{{$enEspera->forma_pago}}</td>
                    <td style="text-align: center">{!!number_format($enEspera->importe, 0,',', '.')!!}</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                     
                      <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                      
                     
                       <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $enEspera->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>

                        @if($enEspera->id_estado == 12 || $enEspera->id_estado == 5) 
                        <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary disabled-btn remisa"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                        @else
                        <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary  remisa"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                        @endif 

                        <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="logistica/Ventas/editar/{{$enEspera->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a>

                        <button data-toggle="tooltip" data-placement="top"  title="Nota" class="btn btn-primary nota"  value="{{ $enEspera->id }}"><i class="fa fa-lg fa-comment-o" ></i></button>
                      </div>
                    </td>
                  </tr>
                  
                @endforeach

              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endif
{{-- FIN TABLA EN ESPERA  --}}

{{-- TABLA PROCESADA --}}
{{-- ESTA TABLA SOLO APARECE CUANDO HAY VENTAS ESTADO 3 Y 8 --}}
@if(count($procesadas) > 0)
 <div class="col-12" >
  <div class="tile ">
    <h3 class="tile-title text-center text-md-left"> Ventas Procesadas </h3> 
     <div class="tile-body ">
      <div class="table-responsive">
            <table class="table table-hover table-bordered " id="esperas-list">
              <thead>
                <tr>
                  <th style="text-align: center;">Venta</th>
                  <th style="text-align: center;">Cliente</th>
                  <th style="text-align: center;">Teléfono</th>
                  <th style="text-align: center;">Dirección</th>
                  <th style="text-align: center">Fecha</th>
                  <th style="text-align: center;">Fecha Activo</th>
                  <th style="text-align: center;">Ciudad</th>
                  <th style="text-align: center;">Horario</th>
                  <th style="text-align: center;">Forma Pago</th>
                  <th style="text-align: center;">Importe</th>
                  <th style="text-align: center;">Acciones</th>
                </tr>
              </thead>
              <tbody>

                <!-- jgonzalez LISTADO DE VENTAS EN ESPERA-->
                
                @foreach($procesadas as $procesada)
                 <tr>
                    <td class="venta" <?php $x=0; ?>
                                        @for($i=0; $i<$longitud; $i++)
                                          @if($procesada->id==$notaventa[$i]->id_venta)
                                             <?php $x=$x+1; ?>
                                                @if($x==1)
                                                   data-id="{{$procesada->id}}"
                                                @endif
                                          @endif
                                        @endfor  style="text-align: center; width:15%">{{$procesada->id}}    
                        <?php $x=0; ?>
                          @for($i=0; $i<$longitud; $i++)
                                 @if($procesada->id==$notaventa[$i]->id_venta)
                              <?php $x=$x+1; ?>
                               @if($x==1)
                                 &spades;
                               @endif
                              @endif
                        @endfor

                                <div class="toolTip" id="{{$procesada->id}}" style="display: none;">
                          @foreach($nota as $item)
                            @if($item->id_venta==$procesada->id)
                                 <table style="border:0px; width: 850px; font-size: 12px; ">
                                  <td style="border:0px; text-align: left; width: 140px;">{{$item->fecha}}</td>
                                  <td style="border:0px; text-align: left; width: 110px;">{{$item->nombre}}</td>
                                  <td style="border:0px; text-align: left;">{{$item->nota}}</td>
                                 </table>
                            @endif
                          @endforeach
                                </div>
                      </td>
                    </td>
                    <td style="text-align: left;">{{$procesada->nombres}}</td>
                    <td style="text-align: center">{{$procesada->telefono}}</td>
                    <td style="text-align: left;">{{$procesada->direccion}}</td>
                    <td style="text-align: center">{{$procesada->fecha}}</td>
                    <td style="text-align: center">{{$procesada->fecha_activo}}</td>
                    <td style="text-align: left;">{{$procesada->ciudad}}</td>
                    <td style="text-align: center">{{$procesada->horario}}</td>
                    <td style="text-align: center">{{$procesada->forma_pago}}</td>
                    <td style="text-align: center">{!!number_format($procesada->importe, 0,',', '.')!!}</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                     
                      <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $procesada->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                      
                     
                       <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $procesada->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>

                       <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary  remisa"  value="{{ $procesada->id }}" disabled><i class="m-0 fa fa-lg fa-plus"></i></button>
                     
                        <button  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" disabled><i class="m-0 fa fa-lg fa-pencil"></i></button>

                        <button data-toggle="tooltip" data-placement="top"  title="Nota" class="btn btn-primary nota"  value="{{ $procesada->id }}"><i class="fa fa-lg fa-comment-o" ></i></button>
                      </div>
                    </td>
                  </tr>
                  
                @endforeach

              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endif
</div>
{{-- FIN TABLA PROCESADA --}}

{{-- MODALES --}}
<!-- Modal -->
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form name="formd"   name="formd" class="form-horizontal" novalidate="">
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">Cliente</th>
                <th style="text-align: center;">Ruc</th>
                <th style="text-align: center;">Teléfono</th>
                <th style="text-align: center;">Email</th>              
              </tr>
            </thead>
            <tbody id="cliente_detalle"> 
            </tbody>
          </table>
        </div>
        <div class="table-responsive">
           <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">Dirección</th>             
                <th colaspan="2" style="text-align: center;">Zona</th>
                <th colaspan="2" style="text-align: center;">Ubicación</th>
              </tr>
            </thead>
            <tbody id="cliente_detalle2">  
            </tbody>
          </table>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">Tipo Cliente</th>
                <th style="text-align: center;">Fecha Venta</th>
                <th style="text-align: center;">Fecha Entrega</th>
                <th style="text-align: center;">Forma de Pago</th>
              </tr>
            </thead>
            <tbody id="cliente_detalle3">
            </tbody>
          </table>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">Horario de Entrega</th>
                <th style="text-align: center;">Vendedor</th>
              </tr>
            </thead>
            <tbody >
              <tr>
                <td style="text-align: center;"> 
                  <select class="form-control horarios" id="idhorario" name="idhorario"> 
                  </select>
                </td>
                <td style="text-align: center;" class="vendedor"></td> 
              </tr>
            </tbody>
          </table>
        </div> 
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">Código</th>
                <th style="text-align: center;">Producto</th>
                <th style="text-align: center;">Cantidad</th>
                <th style="text-align: center;">Precio</th>
                <th style="text-align: right;">Importe</th>
              </tr>
            </thead>
            <tbody id="productos_detalle">     
          </tbody>  
          </table>
        </div>  
        <div class="table-responsive">
           <table class="table" >
            <thead id="historico_n">
            </thead>
             <tbody id="historico_notas">  

             
           
            </tbody>  
          </table>
        </div>
     </form>
            <div class="text-right col-md-">
               <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
               <button class="btn btn-primary" id="btn-save-edit" >Guardar</button>
               <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
               <input type="hidden" name="id_venta" id="id_venta" value="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{--  --}}
<div class="modal fade" id="ModalFactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered " role="document">
    <div class="modal-content">        
      <div class="modal-header">
         <h5 class="modal-title" id="titlef"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
        <div class="table-responsive">
          <table class="table ">
         <div style="display: none;" class="alert-top fixed-top col-12  text-center alert alert-danger" id="remodal"> </div>
                      <tbody>
              <tr>
                  <form name="formfactura"  action="{{route('logistica.factura')}}" target="_blank">
                      <input type="hidden" name="id_ventaf" id="id_ventaf" value="0">
                      <th>Factura</th>
                      <td><input class="form-control" type="text" id="num_fact" name="num_fact" ></td>
                      <td>
                        <div class="col-md-12 ">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" value="1" type="radio" id="tipof" name="tipof" checked>Ver
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                           <input class="form-check-input" value="2" type="radio" id="tipof2" name="tipof">Pdf
                         </label>
                       </div>
                     </div>
                    </td>
                      <td>
                          <button class="btn btn-primary fact" id="btn-fact"  formtarget="_blank" ><i class="m-0 fa fa-lg fa-print" ></i></button>
                      </td>
                   </form>
                </tr>
                <tr>
                  <form name="form1"  action="{{ route('logistica.movimiento') }}" >
                      <input type="hidden" name="id_ventam" id="id_ventam" value="0">
                      <th >Movimiento</th>
                      <td  colspan="1"></td>
                      <td>
   
                      <div class="col-md-12 ">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" value="1" type="radio" id="tipo" name="tipo" checked>Ver
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                           <input class="form-check-input" value="2" type="radio" id="tipo" name="tipo">Pdf
                         </label>
                       </div>
                     </div>
                    </td>
                      <td>
                      <button class="btn btn-primary"  formtarget="_blank"  ><i class="m-0 fa fa-lg fa-print"></i></button>
                      </td>
                   </form>
                </tr>
                <tr>
                  <form name="form1" action="{{ route('logistica.recibo') }}" >
                      <input type="hidden" name="id_ventar" id="id_ventar" value="0">
                      <th>Stikers</th> 
                      <td  colspan="1"></td>
                      <td>
   
                      <div class="col-md-12 ">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" value="1" type="radio" id="tipo" name="tipo" checked>Ver
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                           <input class="form-check-input" value="2" type="radio" id="tipo" name="tipo">Pdf
                         </label>
                       </div>
                     </div>
                    </td>
                      <td >
                      <button class="btn btn-block btn-primary btn-xs" formtarget="_blank" ><i class="m-0 fa fa-lg fa-print" ></i></button>
                      </td>
                   </form>
                </tr>
             
            </tbody>
          </table>
        </div>
   
      </div>
    </div>  
  </div>  
</div>
{{--  --}}

<div class="modal fade" id="ModalNota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog  modal-dialog-centered " role="document">
                   <div style="display: none;" class="alert-top fixed-top text-center alert alert-danger remodal" id="remodal"> </div>
                <div class="modal-content">
                <div class="modal-header">   
                    <h4 class="modal-title" id="myModalLabel">Agregar Nota</h4>
                </div>
                <form id="frmnota" name="frmnota" class="form-horizontal" novalidate="">
                    <textarea type="text" rows="4" maxlength="100" class="form-control" name="nota"  id="nota"></textarea>
                </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-nota">Guardar</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
                    <input type="hidden" id="id_venta" name="id_venta" value="0">
                    <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
                </div>
            </div>
        </div>
   </div>
{{-- FIN MODALES --}}
@endsection

@push('scripts')

<script type="text/javascript">

function addCommas(nStr) { 
    nStr += ''; 
    var x = nStr.split('.'); 
    var x1 = x[0]; 
    var x2 = x.length > 1 ? '.' + x[1] : ''; 
    var rgx = /(\d+)(\d{3})/; 
    while (rgx.test(x1)) { 
     x1 = x1.replace(rgx, '$1' + '.' + '$2'); 
    } 
    return x1 + x2; 
} 


function ventas(){
    $.ajax({
        type: "get",
        url: '{{ route('remisa0') }}',
        dataType: "json",
        success : function(response) {
        var montos = [];                      
        $.each( response.ventas, function(row, items){

            $('#empleado0').append('<li class="d-flex justify-content-between text-row ui-sortable-handle" data-importe="'+items.importe+'" data-venta-id="'+items.id+'">'+items.id+'<a id="" class="eliminaRemisa" data-venta-id="'+items.id+'"><i class="fa fa-times"></i></a></li>')

            // //console.log(items.id);
            // $('.empleado'+items.id+' li').each(function () {
            //     montos.push ($(this).data('importe'))
            // });   

        });
            
        }
    });
}

$(document).ready(ventas);   

$(function() {

        var url = '{{ route('saveRemisa') }}';
        $('ul[id^="empleado"]').sortable(
                {
        cursor: "move",
        connectWith : ".sortable",
        receive : function(e, ui) {
            var empleado_id = $(ui.item).parent(".sortable").data("empleado-id");
            var venta_id = $(ui.item).data("venta-id");
            var sender = ui.sender.data("empleado-id");
           
            $.ajax({
                type: "get",
                url: url+'/'+empleado_id+'/'+venta_id,
                dataType: "json",
                data: { empleado_id: empleado_id, venta_id:venta_id },
                success : function(response) {

                    var montos = [];
                    var montos2 = [];
                    var suma = 0;
                    var suma2 = 0;

                    //CALCULA LOS REGISTROS EN LA TARJETA QUE RECIBE
                    $('.empleado'+empleado_id+' li').each(function () {
                        montos.push ($(this).data('importe'))
                    });
                    for(var x = 0; x < montos.length; x++){
                      suma += montos[x];
                    } 
                    $('#total'+empleado_id).html('');  
                    var total = addCommas(suma);        
                    $('#total'+empleado_id).html(total);

                    //CALCULA LOS REGISTROS DE LA TARJETA QUE ABANDONA
                    $('.empleado'+sender+' li').each(function () {
                        montos2.push ($(this).data('importe'))
                    });
                    for(var x = 0; x < montos2.length; x++){
                      suma2 += montos2[x];
                    } 
                    $('#total'+sender).html('');  
                    var total2 = addCommas(suma2);     
                    $('#total'+sender).html(total2);
                    
                }
            });
        }

    }).disableSelection();

        $('button[id^="btnSaveRemito"]').on('click',function(){
            var empleado_id = $(this).data('empleado-id');
            var ventas = [];
            var montos = [];
            var id_usuario = '{{ $id_usuario }}';
            
            $('.empleado'+empleado_id+' li').each(function () {
                ventas.push  ($(this).data('venta-id')); 
                montos.push ($(this).data('importe'));
         
            });
            //console.log(montos);

             var suma = 0;
            for(var x = 0; x < montos.length; x++){
              suma += montos[x];
            } 
            $('#total'+empleado_id).html('');       
            $('#total'+empleado_id).html(suma);

            console.log(ventas);
            $.ajax({
                type: "get",
                url: '{{ route('saveRemito') }}',
                dataType: "json",
                data: { id_delivery: empleado_id, suma:suma, ventas:ventas, montos:montos, id_usuario:id_usuario },
                success : function(response) {
                    
                    console.log(response); 

                    
                }
            });




        });

        $(document).on('click','.eliminaRemisa', function(){ 
            var venta_id = $(this).data('venta-id');
             $.ajax({
                type: "get",
                url: '{{ route('destroyRemisa') }}' ,
                dataType: "json",
                data: { venta_id:venta_id },
                success : function(response) {
                  if (response == 1) {
                    $('#empleado0').html('');
                    ventas(); 
                  }
                }
            });
        });
    });

 $('.reset').click(function(){
   
       $('#buscador').val('');
            location.reload(true);
  

 });

$(document).ready(function(){
   
    $('.venta').hover(function () {
         var data_id = $(this).data('id');

    
       $('.toolTip').each(function() {
           var div = $(this);

          if(div.attr('id') == data_id){
              div.show();
          }else{
            div.hide();
          }

      }); 
           
    },

    function () { $('.toolTip').css("display","none");}
   );
   
});

$('.horario').click(function(){

  var option=this.checked;
  var id= $(this).val();
 
  $.ajax({
        type: "GET",
        url: '{{ url('onoffhorario') }}',
        dataType: "json",
        data: { option:option, id:id, _token: '{{csrf_token()}}'},

        success: function (data){

           if(option==true)
           {
            $("#res").html("Horario Activo.");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
           }else{
            $("#res").html("Horario Inactivo.");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

           }
        
        }

    });

});

function SetToHidden(valor) {
var obj = document.getElementById("id_horario");
obj.value = valor;

$("#form1").submit();
}

$(document).on('click', '.nota', function () {
    $('#nota').val("");
    var idventa = $(this).val();
    $('#ModalNota').modal('show');
    $('#id_venta').val(idventa);
});

$('#btn-nota').click(function(){
        var id_venta  = $('#id_venta').val();
        var nota      = $('#nota').val();
        var id_usuario= $('#id_usuario').val();
     if ($('#nota').val()==""){

                $(".remodal").html("Por Favor Agregue una Nota");
                $(".remodal").css("display","block");
                $(".remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                return false;
               
        }else{
  
        var formData = {
                    id_usuario:   id_usuario,
                    nota      :   nota,
                    id_venta  :   id_venta
                    }
            
      $.ajax({
        type: "GET",
        url: '{{ url('add_notas') }}',
        dataType: "json",
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data){

               $('#ModalNota').modal('hide');
               $("#res").html("Se Agrego con Éxito una Nota a la Venta");
               $("#res, #res-content").css("display","block");
               $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
     
  location.reload(true);
          }      

    });
  }

 });
  
  $('#btn-activar').click(function(){
   
       $.ajax({
        type: "GET",
        url: '{{ url('activar_venta') }}',
        dataType: "json",
        data: {  _token: '{{csrf_token()}}'},
        success: function (data){
     

          if(data.msjact==0 && data.msjcant==0){

            $("#res").html('La Venta fue Activada');
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 ); 

            location.reload(true);
          }

          if(data.msjact==1 && data.msjcant==1){

            $("#rese").html('No Hay Ventas para Activar a la Fecha');
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

          }

          if(data.msjact==0 && data.msjcant==1){

            $("#rese").html('Hay Ventas que Poseen Productos sin Stock');
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

            } 

            
          
        }
    });


 });
//<!-- Detalle de Venta - Vista rapida de productos en la Venta -->
  $('.detalle').click(function(){

    var id = $(this).val();  //CAPTURA EL ID
    $('#cliente_detalle').html(''); //LIMPIA EL MODAL
    $('#cliente_detalle2').html(''); 
    $('#cliente_detalle3').html(''); 
    $('#cliente_detalle4').html(''); 
    $('#productos_detalle').html(''); //LIMPIA EL MODAL
    $(".horarios").html('');
    $("#historico_n").html('');
    $("#historico_notas").html('');
    $('#ModalProductos').modal('show'); //ABRE EL MODAL
    
      $.ajax({
          type: "get",
          url: '{{ route('horarios_ajax') }}',
          dataType: "json",
          success: function (datas){

             $.each(datas, function(i, item2) {

            $(".horarios").append('<option value='+item2.id+'>'+item2.horario+'</option>');
              });
          }

      });
   
      $.ajax({
        type: "GET",
        url: '{{ url('detalle_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){
          console.log(data);
          var total=0;
          var importe=0;
          var x=0;

          $("#id_venta").val(data.venta[0].id);
          $('#title').html('Detalle de Venta:  ' + data.venta[0].id);
          $("#cliente_detalle").append(`<tr>
                                          <td style="text-align: center;">${data.venta[0].nombres}</td>
                                          <td style="text-align: center;">${data.venta[0].ruc_ci}</td>
                                          <td style="text-align: center;">${data.venta[0].telefono}</td>
                                          <td style="text-align: center;">${data.venta[0].email}</td>
                                      </tr>`);
          $("#cliente_detalle2").append(`<tr>
                                          <td style="text-align: center;">${data.venta[0].direccion}</td>
                                          <td style="text-align: center;">${data.venta[0].barrio}</td> 
                                          <td style="text-align: center;">${data.venta[0].ubicacion}</td> 
                                      </tr>`);
           $("#cliente_detalle3").append('<tr>'+
                                          (data.venta[0].id_tipo==1 ? '<td style="text-align: center;">Natural</td>'
                                           :   '<td style="text-align: center;">Jurídico</td>')+'<td style="text-align: center;">'+data.venta[0].fecha+'</td><td style="text-align: center;">'+data.venta[0].fecha_cobro+'</td> <td style="text-align: center;">'+data.venta[0].forma_pago+'</td></tr>');
          /* $("#cliente_detalle4").append(`<tr>
                                          <td style="text-align: center;"> <select class="form-control horarios" id="horario" name="horario"> 
                 <option value="${data[0].id_horario}"> ${data[0].horario}</option>
                
               </select>
                                         </td>
                                          <td style="text-align: center;">${data[0].fecha}</td> 
                                      </tr>`);*/
            for (var i = 0; i < data.notas.length; i++) {



              if(data.notas[i].id_venta==data.venta[0].id){
                 x=x+1

                if(x==1){
                       $("#historico_n").append(`<tr>
                                        <th colspan="5" style="text-align: center; font-size: 14px;">Historico de Notas</th>
                                      </tr>
                                      <tr>
                                        <th style="text-align: center;">Vendedor</th>
                                        <th  colspan="3"  style="text-align: center;">Nota</th>
                                        <th style="text-align: center;">Fecha</th>
                                      </tr>`);
                }

              }
          }
            
            $.each(data.notas, function(l, item2)
             {
                  if(item2.id_venta==data.venta[0].id){

                    $("#historico_notas").append(` 
                                                  <tr>
                                                    <td style="text-align: center;">${item2.nombre}</td>
                                                    <td  colspan="3" style="text-align: left;">${item2.nota.replace(/~/g, '<br >' )}</td>
                                                    <td style="text-align: center;">${item2.fecha}</td>
                                                   </tr>`);
                  }
                 
             });

          $(".horarios").val(data.venta[0].id_horario);
          $(".vendedor").html(data.venta[0].nameuser);

          //CICLO DE LOS DATOS RECIBIDOS
          $.each(data.venta, function(l, item) {

               importes=item.cantidad*item.precio;
              // total+=importe;
            $("#productos_detalle").append(`<tr>

              <td style="text-align: left;">${item.codigo_producto}</td>
              <td style="text-align: left;">${item.descripcion}</td>
              <td style="text-align: center;">${item.cantidad}</td>
              <td style="text-align: right;">${item.precio.toLocaleString('de-DE')}</td>
              <td style="text-align: right;">${importes.toLocaleString('de-DE')}</td>
              </tr>`);
          });

            $("#productos_detalle").append(`<tr>
              <td colspan="5" style="text-align:  right;"><h5>Total: ${data.venta[0].importe.toLocaleString('de-DE')} Gs.</h5></td>
              </tr>`);
         
           
          }

    });


  });


  $("#btn-save-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
        
        var formData = { id_venta:   $('#id_venta').val(),  
                         horario:    $('#idhorario').val(), 
                         id_usuario: $('#id_usuario').val(),
                       }
   console.log(formData);
    $.ajax({
        type:"PUT",
        url: '{{route('edithorario')}}',
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {

     
              
            $('#formd').trigger("reset");
            $('#ModalProductos').modal('hide');
            $("#res").html("Horario de Venta Modificado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }
         });

      location.reload(true);
   
});
  //<!-- Agregar a Remisa -->
  $('.remisa').click(function(){
    
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('agregar_remisa') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){

              $("#res").html('La Venta fue Remisada');
              $("#res, #res-content").css("display","block");          
              
        }
    });

    location.reload(true);
  });

  //<!-- Quitar de  Remisa -->
  $('.noremisa').click(function(){
    
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('quitar_remisa') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){


            $("#res").html('La Venta fue  No Remisada');
            $("#res, #res-content").css("display","block");
          
            
        }
    });

    location.reload(true);
  });
      

 
  $('.factura').click(function(){

      $('#num_fact').val("");
      $('#id_ventaf').val(""); 
      $('#id_ventam').val(""); 
      $('#id_ventar').val(""); 
      var id = $(this).val();  //CAPTURA EL ID  
  
      $.ajax({
        type: "GET",
        url: '{{ url('fact_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){
          
        
          $('#titlef').html('Pedido: ' + data[0].venta);
          $('#id_ventaf').val(data[0].venta); 
          $('#id_ventam').val(data[0].venta); 
          $('#id_ventar').val(data[0].venta); 

          if (data[0].factura ==2 || data[0].factura ==3){

            if(data[0].impresa==1){
              $('#btn-fact').prop('disabled', true);
              $('#num_fact').prop('disabled', true);
              $('#tipof').prop('disabled', true);
              $('#tipof2').prop('disabled', true);
              


            }else{
              $('#btn-fact').prop('disabled', false);
              $('#num_fact').prop('disabled', false);
              $('#tipof').prop('disabled', false);
              $('#tipof2').prop('disabled', false);
            }
            
          }else{
              $('#btn-fact').prop('disabled', true);
          }      
        
       }

    });
  });

  $(document).ready(function() {
  $('#btn-fact').click(function(){
  event.preventDefault();

    if ($('#num_fact').val()==""){
            $("#remodal").html("El Campo Factura es Requerido");
            $("#remodal").css("display","block");
            $("#remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
            return false;

    }else{
      var id_venta=$('#id_ventaf').val();
      var num_factura=$('#num_fact').val();
      $.ajax({
        type: "GET",
        url: '{{ url('num_factura') }}',
        dataType: "json",
        data: { id:num_factura, _token: '{{csrf_token()}}'},

        success: function (data){

          if (data>0){
           
            $("#remodal").html("Este Numero de Factura ya fue Impreso.");
            $("#remodal").css("display","block");
            $("#remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
          }else{

               document.formfactura.submit();
               $('#ModalFactura').modal('hide');
     
          }      
        
        }

    });

}
 });
   });


 /*    var formData={
        num_tya:$('#num_fact').val(),
        id_venta:  $('#id_venta').val()
      }

  $.ajax({
        type: "GET",
        url: '{{ route('logistica.factura') }}',
        dataType: "json",
        data: {formData, _token: '{{csrf_token()}}'},

        success: function (data){
          
          $('#title').html('Pedido: ' + data[0].venta);
          $('#id_venta').val(data[0].venta); 
          $('#id_ventam').val(data[0].venta); 
          $('#id_ventar').val(data[0].venta); 

          if (data[0].factura ==2 || data[0].factura ==3){
           
               $('#btn-fact').prop('disabled', true);
          }else{
              $('#btn-fact').prop('disabled', false);
          }      
        
  

    });
  });*/

  //<!-- Activar venta En Espera-->
 /* $('.activar').click(function(){
    
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('activar_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){4


                     
            $("#res").html('La Venta fue Activada');
            $("#res, #res-content").css("display","block");
            // $('#respActivarVenta').html('ACTIVADA');     
        }
    });

    location.reload(true);
  });*/



</script>

  
@endpush