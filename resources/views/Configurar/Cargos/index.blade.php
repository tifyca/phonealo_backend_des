<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cargos')
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
        <h3 class="tile-title">Nuevo Cargo</h3>
          <form id="frmc" name="frmc"  novalidate="">
            {{ csrf_field() }} 
		          <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
            <div class="row">
              <div class="form-group col-12  col-md-8">
                <label class="control-label">Nombre</label>
                <input class="form-control"  type="text" placeholder="Ej: Repartidor" id="nombreCargo" name="nombreCargo" onkeypress="return soloLetras(event)">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" value="1" type="radio" id="statusCargo" name="statusCargo" checked>Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input class="form-check-input" value="0" type="radio" id="statusCargo2" name="statusCargo">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
              <div class="tile-footer col-12 col-md-2 text-center border-0" >
                <button class="btn btn-primary"  id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        <div class="tile-body ">
        </div>  
    </div>
  </div>

  
  <div class="col-12">
    <div class="tile">
      {{-- FILTRO --}}
      <div class="col mb-3 text-center">
          
            <form class="row d-flex justify-content-end" action="{{route('cargos.index')}}" method="get">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Cargos</h3>
            </div>
             <div class="form-group col-md-3">
              <input type="text" class="form-control" name="buscarcargos" id="buscarcargos" placeholder="Buscar Cargo">
            </div>
            <div class="form-group col-md-3">
              <select class="form-control" id="selectstatus" name="selectstatus">
                <option value="">Estatus</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            <div class="col-md-1 mr-md-3">
              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">       
            </div>
          </form>
         
        </div>
        {{-- FIN FILTRO --}}
            <div class="tile-body">
            <div class="table-responsive">
              <div class="cargos">
            <table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="cargos-list" name="cargos-list">
                  @foreach($cargos as $cargo)           
                     <tr id="cargo{{$cargo->id}}">
                      <td width="45%" >{{$cargo->cargo}}</td>
                <?php if ($cargo->status==1){ ?>
                      <td width="45%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="45%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="10%" class="text-right">
                      <div class="btn-group">
                      <button  data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$cargo->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$cargo->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $cargos->render(); ?>
              </div>
              </div>
            </div>
            </div>
        </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <div style="display: none;" class="alert-top fixed-top col-12  text-center alert alert-danger" id="remodal"> </div>
      <h4 class="modal-title" id="myModalLabel">Editar Cargo</h4>
     </div>
     <div class="modal-body">
      <form id="frmcargos" name="frmcargos" class="form-horizontal" novalidate="">  
       <div class="row">
              <div class="form-group col-12  col-md-8">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="nombre" name="nombre" onkeypress="return soloLetras(event)">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" value="1" type="radio" id="status" name="status">Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input class="form-check-input" value="0" type="radio" id="status2" name="status">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
          
            </div>
        </div>
      </form>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save-edit" value="update">Guardar</button>
      <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
      <input type="hidden" id="cargo_id" name="cargo_id" value="0">
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
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar Cargo</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea Eliminar este Cargo?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-cargo" >Si</button>
                    <input type="hidden" id="cargo-id" name="cargo-id" value="0">
                </div>
            </div>
        </div>
   </div>

@endsection

@push('scripts')
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Configurar/crud_cargos.js')}}"></script>
 <script type="text/javascript">

/*  $('#buscar').on('keyup',function(){
     $('tbody').html('');
     
     
      var value=$(this).val();
     $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
     $.ajax({
       type : 'get',
       url :'{{ route('searchCargos') }}',
       data:{search:value},
       dataType:'html',
       success:function(data){
       $('tbody').html(data);
       }
       });
    })

  $('#buscar-select').change(function(){
        var valor = $(this).val();
   
          $("tbody").html('');

           $.ajax({
              type: "get",
              url: '{{ route('searchCargos') }}',
              dataType: "html",
              data: {valor: valor},
              success: function (data){
                $('select[name=buscar-select]').val('estatus');
                $('tbody').html(data);
              }
          });
          
      });*/
 
</script>
 

 
@endpush

