@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Ver/Editar Gasto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_show', '') @section('link_back', url('registro/gastos'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
           <form name="form1" action="{{ route('gastos.update', ($gastos->id)) }}"  accept-charset="UTF-8" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
               {{ method_field('PUT') }}  
          <div class="col-12">

                <div class="row">
                  
                    <div class="form-group col-md-6">
                       
                      <label for="categoria_gasto">Categoría de Gastos</label>
                      <input type="hidden" name="bandera" id="bandera" value="{{$sproveedor}}">
                      <input type="hidden" name="categoria_gasto" id="categoria_gasto" value="{{$gastos->id_categoria}}">
                      <input class="form-control" type="text" id="categoria" name="categoria" value="{{$categoria}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="descripcion_gasto">Descripción</label>
                      <input class="form-control read" type="text" id="descripcion_gasto" name="descripcion_gasto" value="{{$gastos->descripcion}}" readonly maxlength="50">
                    </div>
                    
                    <div class="form-group col-md-4">
                      <label for="comprobante_gasto">Comprobante</label>
                      <input class="form-control read" type="text" id="comprobante_gasto" name="comprobante_gasto" value="{{$gastos->comprobante}}" readonly maxlength="32">
                    </div>
                    
                       <div class="form-group col-md-6">
                      <label for="categoria_gasto">Proveedores</label>
                      <select class="form-control" id="id_proveedor" name="id_proveedor" disabled>
                        <option value="">Seleccione</option>
                         @foreach($proveedores as $fuen)
                        <option value="{{$fuen->id}}" @if($fuen->id==$gastos->id_proveedor) selected @endif>{{$fuen->nombres}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="comprobante_gasto">Nro.Solicitud</label>
                      <select class="form-control" id="id_solped" name="id_solped" disabled>
                        <option value="">Seleccione</option>
                         @foreach($solped as $fuen)
                        <option value="{{$fuen->id}}">{{$fuen->id}}</option>
                        @endforeach
                      </select>
                    </div>
                  
                    <div class="form-group col-md-4">
                      <label for="proveedor_gasto">Fuente</label>
                      <select class="form-control read" id="id_fuente" name="id_fuente" disabled>
                        <option value="">Seleccione</option>
                         @foreach($fuentes as $fuen)
                        <option value="{{$fuen->id}}" @if($fuen->id==$gastos->id_fuente) selected @endif>{{$fuen->fuente}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe_gasto">Imnporte</label>
                      <input class="form-control read" type="text" id="importe_gasto" name="importe_gasto" value="{{$gastos->importe}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fecha_comprobante_gasto">Fecha Comprobante</label>
                      <input class="form-control read" type="date" id="fecha_comprobante_gasto" name="fecha_comprobante_gasto" value="{{$gastos->fecha_comprobante}}"readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="divisa_gasto">Divisa</label>
                      <select class="form-control read" id="divisa_gasto" name="divisa_gasto" disabled>
                       
                         <option value="">Seleccione</option>
                          @foreach($divisas as $fuen)
                        <option value="{{$fuen->id_divisa}}" @if($fuen->id_divisa==$gastos->id_divisa) selected @endif>{{$fuen->divisa}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="cambio_gasto">Cambio</label>
                      <input class="form-control read" type="text" id="cambio_gasto" name="cambio_gasto" value="{{$gastos->cambio}}"readonly>
                    </div>
                   
                  
                    <div class="form-group col-md-12">
                      <label for="observaciones_gastos">Observaciones</label>
                      <textarea class="form-control read" id="observaciones_gastos" name="observaciones_gastos" rows="3" disabled maxlength="255">{{$gastos->observaciones}}</textarea>
                    </div>
                    <div class="tile-footer col-12 d-flex align-items-center">
                         <div class="form-check mr-3">
                          <label class="form-check-label">
                            <input class="form-check-input" id="editar" type="checkbox">Editar
                          </label>
                        </div>
                        <div class="">
                          <button class="btn btn-primary read" type="submit" disabled>Guardar</button>
                        </div>
                    </div>
                  </div>
                </div>
              </form>
      </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

<script type="text/javascript" charset="utf-8" async defer>
  $('#editar').change(function(){
    if ($('#editar').prop('checked')){

      $('.read').prop('readonly', false);
      $('.read').prop('disabled', false);
      if(document.form1.bandera.value=='1'){
        document.form1.id_proveedor.disabled=false;
        document.form1.id_solped.disabled=false;
      }else{
        document.form1.id_proveedor.disabled=true;
        document.form1.id_solped.disabled=true;

      }
    }
    else{
      $('.read').prop('readonly', true);
      $('.read').prop('disabled', true);
       document.form1.id_proveedor.disabled=true;
        document.form1.id_solped.disabled=true;
    }
  });
</script>

@endpush