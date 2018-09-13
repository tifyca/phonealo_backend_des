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
              

<div class="row">
  <div class="col-12">
    {{-- LA CAJA DURA ABIERTA 24 HORAS. A LAS 12PM SI UNA CAJA ESTA ABIERTA PASA A UN ESTADO 'POR CERRAR' Y NO PERMITE ABRIR UNA NUEVA CAJA EN EL NUEVO DIA. EL USUARIO DEBE CERRARLA PARA ABRIR UNA NUEVA. EN ESTE CASO APARECE ESTE MENSAJE Y EL BOTON DE 'CERRAR CAJA' --}}
    <div class="card text-white bg-danger mb-3 col-12">
      
      <div class="card-body">
        <h3 class="card-title">¡Aun queda una caja abierta!</h3>
        
      </div>
    </div>
    <div class="row d-flex justify-content-around">
    {{-- ESTE BOTON ESTA AQUI SOLO DE DEMOSTRACION MIENTRAS NO EXISTA LA FUNCIONALIDAD. SI LA CAJA ESTA DISPONIBLE ABRIRA DIRECTAMENTE Y REDIRECCIONA A LA VISTA 'ABRIR' ESO QUIERE DECIR QUE ESTA VISTA 'INDEX' SOLO SE MUESTRA SI LA CAJA DEL DIA ANTERIOR ESTA ABIERTA Y NECESITA SER CERRADA --}}
      <div class="col-md-3">
        <a href="{{ route('caja.abrir') }}" title="" class="link-card">
          <div class="widget-small info"><i class="icon fa fa-check fa-3x"></i>
            <div class="info">
              <h4>Caja</h4>
            </div>
          </div>
        </a>
      </div>
      {{--  --}}
      <div class="col-md-3">
        <a href="{{ route('caja.cerrar') }}" title="" class="link-card">
          <div class="widget-small danger "><i class="icon fa fa-close fa-3x"></i>
            <div class="info">
              <h4>Cerrar Caja</h4>
            </div>
          </div>
        </a>
      </div>
    </div>
   {{--  <div class="tile">
        <h3 class="tile-title">Abrir Caja</h3>
        <div class="tile-body ">
     
        </div>
    </div> --}}
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush