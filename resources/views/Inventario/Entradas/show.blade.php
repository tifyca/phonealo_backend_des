@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nueva Entrada')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('inventario/entradas'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <div class="tile-body ">
          <form>
          <div class="row">
            <div class="form-group col-12 col-md-3">
              <label for="tipo_entrada">Tipo de Entrada</label>
              <select class="form-control" id="tipo_entrada" name="tipo_entrada">
                <option value="">Seleccione</option>
                <option>Pedido</option>
                <option>Carga Inicial</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha</label>
              <input class="form-control" type="date" id="fecha_entrada" name="fecha_entrada" >
            </div>
            <div class="form-group col-md-3">
              <label for="n_documento_entrada">Número de Documento</label>
              <input class="form-control" type="text" id="n_documento_entrada" name="n_documento_entrada" placeholder="...">
            </div>
            <div class="form-group col-md-3">
              <label for="proveedor_entrada">Proveedor</label>
              <select class="form-control" id="proveedor_entrada" name="proveedor_entrada">
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
           
          </div>
       
        </div>
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
      <h3 class="tile-title text-center text-md-left">Detalles del Producto</h3>
        <div class="tile-body ">
          <div class="row">

            <div class="form-group col-md-1">
              <label for="cod_entrada">Cod.</label>
              <input class="form-control" type="text" id="cod_entrada" name="cod_entrada" >
            </div>
            <div class="form-group col-md-4">
              <label for="descripcion">Descripción</label>
              <input class="form-control" type="text" id="descripcion" name="descripcion" >
            </div>
            <div class="form-group col-md-2">
              <label for="precio_entrada">Precio</label>
              <input class="form-control" type="text" id="precio_entrada" name="precio_entrada" >
            </div>
            <div class="form-group col-md-2">
              <label for="cantidad_entrada">Cantidad</label>
              <input class="form-control" type="text" id="cantidad_entrada" name="cantidad_entrada" >
            </div>
            <div class="form-group col-md-2">
              <label for="Total">Total</label>
              <input class="form-control" type="text" id="Total" name="Total" readonly >
            </div>
            <div class="col-sm-1">
              <a class="btn btn-primary mt-4" href="#"><i class=" m-0 fa fa-lg fa-plus"></i></a>
            </div>

          </div>
        </div>
         <div class="tile-footer col-12 pl-3">
              <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
    </div>
  </div>
   </form>
</div>

  

@endsection

@push('scripts')
  
@endpush