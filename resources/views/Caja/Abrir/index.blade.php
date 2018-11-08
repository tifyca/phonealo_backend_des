 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Abrir Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', url('') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
@php
  
@endphp              
<div class="row">
  <div class="col-12">
    {{-- LA CAJA DURA ABIERTA 24 HORAS. A LAS 12PM SI UNA CAJA ESTA ABIERTA PASA A UN ESTADO 'POR CERRAR' Y NO PERMITE ABRIR UNA NUEVA CAJA EN EL NUEVO DIA. EL USUARIO DEBE CERRARLA PARA ABRIR UNA NUEVA. EN ESTE CASO APARECE ESTE MENSAJE Y EL BOTON DE 'CERRAR CAJA' --}}
    {{-- @if (true == false) --}}
    @if ( isset($caja) )
      @if ( $caja->id_estado == 1 )
        <div class="card text-white bg-danger mb-3 col-12 text-center">      
          <div class="card-body">
            <h3 class="card-title">¡Posee una caja abierta! de fecha {{ $fecha }}</h3>        
          </div>
        </div>
      @else
        <div class="card text-white bg-danger mb-3 col-12 text-center">      
          <div class="card-body">
            <h3 class="card-title">No posee caja abierta</h3>        
          </div>
        </div>
      @endif    
    @endif
    {{-- @endif --}}
    <div class="row d-flex justify-content-around">
    {{-- ESTE BOTON ESTA AQUI SOLO DE DEMOSTRACION MIENTRAS NO EXISTA LA FUNCIONALIDAD. SI LA CAJA ESTA DISPONIBLE ABRIRA DIRECTAMENTE Y REDIRECCIONA A LA VISTA 'ABRIR' ESO QUIERE DECIR QUE ESTA VISTA 'INDEX' SOLO SE MUESTRA SI LA CAJA DEL DIA ANTERIOR ESTA ABIERTA Y NECESITA SER CERRADA --}}
      @if ( isset($caja) )        
        @if ( $caja->id_estado == 1 )
          <div class="col-md-3">
            <a href="{{ route('caja.abrir', $caja->id ?? "") }}" title="" class="link-card" id="abrir_caja">
              <div class="widget-small warning"><i class="icon fa fa-check fa-3x"></i>
                <div class="info">
                  <h4>Abrir Caja</h4>
                </div>
              </div>
            </a>
          </div>
        @endif
      @endif 
      @if ( !isset($caja) || isset($caja) )             
        @if ( !isset($caja) || $caja->id_estado <> 1 )
        <div class="col-md-3">
          <a href="" title="" class="link-card" id="crear_caja" data-toggle="modal" data-target="#modalCrearCaja">
            <div class="widget-small info"><i class="icon fa fa-plus-square fa-3x"></i>
              <div class="info">
                <h4>Crear Caja</h4>
              </div>
            </div>
          </a>
        </div>
        @endif
      @endif 
      @if ( isset($caja) )
        @if ( $caja->id_estado == 1 )          
          <div class="col-md-3">
            <a href="{{ route('caja.cerrar', $caja->id ?? "") }}" title="" class="link-card" id="cerrar_caja">
              <div class="widget-small danger "><i class="icon fa fa-close fa-3x"></i>
                <div class="info">
                  <h4>Cerrar Caja</h4>
                </div>
              </div>
            </a>
          </div>
        @endif
      @endif    
    </div>
   {{--  <div class="tile">
        <h3 class="tile-title">Abrir Caja</h3>
        <div class="tile-body ">
     
        </div>
    </div> --}}
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCrearCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear Caja</h5>
      </div>
      <form action="{{ route('caja.crear') }}" method="post">
        <div class="modal-body">
          {{ csrf_field() }}       
          <div class="col-12 mt-4">
            <div class="row d-flex justify-content-center">
             <div class="col form-group">
                <label for="monto_apertura" class="">Monto apertura de caja</label>
                <input type="number" class="form-control" placeholder="Monto apertura. Mínimo 500.000" min="500000" id="monto_apertura" name="monto_apertura" required>  
             </div>        
            </div>
          </div>
         {{--  <div class="col-12 mt-4">
            <div class="row d-flex justify-content-center">
              <div class="col from-group">
                <label for="observaciones">Comentario apertura caja</label>
                <textarea id="observaciones" name="observaciones" rows="3" class="form-control" required placeholder="Ingresa comentario respecto a la apertura de caja"></textarea>
              </div>
            </div>
          </div> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Crear</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  
@endpush