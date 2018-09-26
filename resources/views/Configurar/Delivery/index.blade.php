<?php
if(isset($_SESSION["user"]))
 $id_usuario= $_SESSION["user"];


?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Montos Deliverys')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')


<div class="row">
  <div class="col-12">
    <div class="tile">
      <h3 class="tile-title">Nuevo Montos Delivery</h3>
      <div class="tile-body ">
        <form id="frmc" name="frmc"  novalidate="">
          {{ csrf_field() }} 
          <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
          <div class="row">
           <div class="form-group col-12  col-md-4">
            <label class="control-label">Monto</label>
            <input class="form-control" type="text" placeholder="..." id="nombreCategoria" name="nombreCategoria" onkeypress="return solonumeros(event)" oncopy="return false" onpaste="return false"  maxlength="50">
          </div>
                       
      
          <div class="tile-footer text-center border-0" >
            <button class="btn btn-primary save" type="submit" id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>

<div class="col-12">
  <div class="tile">
    {{-- FILTRO --}}
    <div class="col mb-3 text-center">
          <h3 class="tile-title text-left text-md-left">Listado de Montos Delivery</h3>
          
     <div class="row"> 
      <!--form class="row d-flex justify-content-end" action="{{route('montos_delivery.index')}}" method="get"--> 
       
        <div class="form-group col-md-3">
          <input type="text" class="form-control" id="buscarmonto" name="buscarmonto" placeholder="Buscar"  maxlength="50">
        </div>

        <div class="col-md-1 mr-md-2">
          <button  id="btnBuscar" class="btn btn-primary">Filtrar</button>             
        </div>
      <!--/form-->
    </div>
</div>
    {{-- FIN FILTRO --}}
    <div class="tile-body ">
      <div class="table-responsive">
        <div class="montos_delivery" id="divmontos_delivery">
                @component('Configurar.Delivery.lista')
                        @slot('montos_delivery', $montos_delivery)
                @endcomponent
      </div>
    </div>

  </div>
</div>
</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
     <div style="display: none;" class="alert-top fixed-top col-12  text-center alert alert-danger" id="remodal"> </div>
     <h4 class="modal-title" id="myModalLabel">Editar Montos Delivery</h4>
   </div>
   <div class="modal-body">
    <form id="frmcategorias" name="frmcategorias" class="form-horizontal" novalidate="">

     <div class="row">
      <div class="form-group col-12  col-md-8">
        <label class="control-label">Nombre</label>
        <input class="form-control" type="text" placeholder="..." id="nombre" name="nombre" onkeypress="return soloLetras(event)" oncopy="return false" onpaste="return false"  maxlength="50">
      </div>


   </div>
 </div>
</form>
<div class="modal-footer">
  <button type="button" class="btn btn-primary" id="btn-save-edit" value="update">Guardar</button>
  <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
  <input type="hidden" id="categoria_id" name="Categoria_id" value="0">
  <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
</div>


</div>
</div>
</div>

</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Eliminar Monto</h4>
      </div>
      <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
        <div class="modal-body">
          <p>Está seguro que desea Eliminar esta Montos Delivery?</p>
          <p class="debug-url"></p>
        </div>
      </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
        <button type="button" class="btn btn-danger delete-categoria" >Si</button>
        <input type="hidden" id="categoria-id" name="categoria-id" value="0">
      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')
<meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{asset('js/Configurar/crud_delivery.js')}}"></script>
<script type="text/javascript">



</script>


@endpush