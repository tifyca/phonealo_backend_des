 @extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cierres')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Cierres</h3>
            </div>
            
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Usuario</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
        </div>
        <div class="tile-body ">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                                         
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Ingreso Efectivo</th>
                    <th>Ingreso POS</th>
                    <th>Ingreso OTROS</th>
                    <th>Salidas</th>
                    <th>Gastos</th>
                    <th>Total ingreso</th>
                    <th>Acciones</th>                    
                    
                  </tr>
                </thead>
                <tbody>
                  <tr class="table-warning">
                    
                    <td>Fecha</td>
                    <td>Usuario</td>
                    <td>Ingreso Efectivo</td>
                    <td>Ingreso POS</td>
                    <td>Ingreso OTROS</td>
                    <td>Salidas</td>
                    <td>Gastos</td>
                    <td>Total ingreso</td>  
                    
                     <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver Resumen" href="{{ route('caja.cierre.resumen') }}"><i class="m-0 fa fa-lg fa-file-text"></i></a>
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver Informe" href="{{ route('caja.cierre.informe') }}"><i class="m-0 fa fa-lg fa-file-text-o"></i></a>
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Confirmar" href="#"><i class="m-0 fa fa-lg fa-check"></i></a>
                      </div>
                    </td>
                    
                  </tr>
                  <tr>
                    
                    <td>Fecha</td>
                    <td>Usuario</td>
                    <td>Ingreso Efectivo</td>
                    <td>Ingreso POS</td>
                    <td>Ingreso OTROS</td>
                    <td>Salidas</td>
                    <td>Gastos</td>
                    <td>Total ingreso</td>  
                    
                     <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver Resumen" href="{{ route('caja.cierre.resumen') }}"><i class="m-0 fa fa-lg fa-file-text"></i></a>
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver Informe" href="{{ route('caja.cierre.informe') }}"><i class="m-0 fa fa-lg fa-file-text-o"></i></a>
                      
                      </div>
                    </td>
                    
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
  
@endpush