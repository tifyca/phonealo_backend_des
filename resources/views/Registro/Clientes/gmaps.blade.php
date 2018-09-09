<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar Cliente')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/clientes'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCyHv2UsAyv6nkFSUKFMrI-tJzNrvHdEyE"></script>
<div class="row" align="center">
  <div class="col-12">
    <div class="">
      <div class="tile-body ">
      	  <div style="width: 100%; height: 650px;" >
				{!! Mapper::render() !!}
			</div>

        
      </div>
    </div>
  </div>
</div>



@endsection
