 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', url('') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12 col-md-7">
    <div class="tile">
        <div class="d-flex justify-content-between">
          <h5 class=" text-left">{{ auth()->user()->name }}</h5>
          <h5 class="text-right">{{ $fecha }}</h5>
        </div>
        <hr>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <tbody>
                <tr>
                  <th>Total ingresos efectivo</th>
                  <td>{!!number_format($total_efectivo , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total ingreso POS</th>
                  <td>{!!number_format($total_pos , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total ingreso Otros</th>
                  <td>{!!number_format($total_otros , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total Salidas</th>
                  <td>{!!number_format($total_salidas , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total Gastos</th>
                  <td> PENDIENTE </td>
                </tr>
                <tr class="table-secondary">
                  <th class="text-right">NETO EFECTIVO EN CAJA</th>                  
                  <td><b>{!!number_format($total_neto , 0, ',', '.')!!}</b></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
  <div class="col-12 col-md-5">
    <div class="row ">
      <div class="col-12">
        <a href="{{ route('caja.remitos', ['caja' => $caja->id]) }}" title="" class="link-card">
          <div class="widget-small primary"><i class="icon fa fa-file fa-3x"></i>
            <div class="info">
              <h4>Registrar Cobro de Remitos</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12"> 
        <a href="{{ url('registro/gastos/show') }}" title="" class="link-card">
          <div class="widget-small info "><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Registrar Gastos</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12">
        <a href="{{ route('caja.salida',['caja' => $caja->id]) }}" title="" class="link-card">
          <div class="widget-small  warning"><i class="icon fa fa-file-o fa-3x"></i>
            <div class="info">
              <h4>Salidas</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-6">
        <a href="{{ route('caja.detalle',['caja' => $caja->id]) }}" title="" class="link-card">
          <div class="widget-small info "><i class="icon fa fa-list fa-3x"></i>
            <div class="info">
              <h4>Detalles de Caja</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-6">
        <a href="{{ route('caja.cerrar', $caja->id) }}" title="" class="link-card">
          <div class="widget-small danger "><i class="icon fa fa-close fa-3x"></i>
            <div class="info">
              <h4>Cerrar Caja</h4>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
        
      <h3 class="tile-title text-center text-md-left">Salidas de Caja en Efectivo </h3>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead>
                <tr class="table-secondary">
                  <th>Descripción</th>
                  <th>Referencia</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody>
               @foreach ($salidasEfectivo as $salidaEfectivo)
                 <tr>
                   <td>{{ $salidaEfectivo->descripcion }}</td>    
                   <td>{{ $salidaEfectivo->referencia_detalle }}</td>    
                   <td>{!!number_format($salidaEfectivo->importe , 0, ',', '.')!!} </td>   

                 </tr>
               @endforeach
              </tbody>
            </table>
            {{-- {{ $salidasEfectivo->render() }} --}}
            {{ $salidasEfectivo->appends( Request::only(['caja']) )->links() }}
          </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush