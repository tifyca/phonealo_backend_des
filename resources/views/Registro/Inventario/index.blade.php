@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Inventario')
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
        <div class="tile-body ">
          <form>
            <div class="row">
              <div class="form-group col-12  col-md-6">
                <label class="control-label" for="producto_inventario">Productos</label>
                <input class="form-control" type="text" id="producto_inventario" name="producto_inventario" >
              </div>
              <div class="form-group col-12  col-md-6">
                <label class="control-label" for="cantidad_inventario">Cantidad</label>
                <input class="form-control" type="text" id="cantidad_inventario" name="cantidad_inventario" >
              </div>
              <div class="form-group col-12  col-md-6">
                <label class="control-label" for="descompuesto_inventario">Descompuesto</label>
                <input class="form-control" type="text" id="descompuesto_inventario" name="descompuesto_inventario" >
              </div>
               <div class="form-group col-12  col-md-6">
                <label class="control-label" for="stock_inventario">Stock</label>
                <input class="form-control" type="text" id="stock_inventario" name="stock_inventario" disabled>
              </div>
              <div class="tile-footer col-12 text-center" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;{{-- <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a> --}}
              </div>
            </div>
          </form>
        </div>
        
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
        <div class="tile-body ">
          <div class="tile-body table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                  </tr>
          

                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush