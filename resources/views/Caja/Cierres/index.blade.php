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
          <form class="row" method="get" action="{{ route('caja.cierres') }}">             
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Cierres</h3>
            </div>
            
            <div class="form-group col-md-2 p-0">
              <input type="date" class="form-control" name="fecha">
            </div>
          
            <div class="form-group col-md-2 p-0">
              <select class="form-control" id="" name="usuario">
                <option value="" selected>Usuarios</option>
                @foreach ($usuarios as $usuario)
                  <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-1">
              <button class="btn btn-primary" type="submit">Filtrar</button>
            </div>
            {{ csrf_field() }}
          </form>
        </div>
        <div class="tile-body ">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead class="text-center">
                  <tr>                                        
                   {{--  <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Ingreso Efectivo</th>
                    <th>Ingreso POS</th>
                    <th>Ingreso OTROS</th>
                    <th>Salidas</th>
                    <th>Gastos</th>
                    <th>Total ingreso</th>
                    <th>Acciones</th>       --}}                                  

                    <th>Caja</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Monto apertura</th>
                    <th>Monto cierre</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @foreach ($cierres as $cierre)
                   <tr>
                    <td>{{ $cierre->caja_id }}</td>
                    <td>{{ $cierre->fecha }}</td>
                    <td>{{ $cierre->user_nombre }}</td>
                    <td>{!!number_format($cierre->monto_apertura, 0, ',', '.')!!}</td>
                    <td>{!!number_format($cierre->monto_cierre, 0, ',', '.')!!}</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver Resumen" href="{{ route('caja.cierre.resumen', $cierre->caja_id) }}">
                          <i class="m-0 fa fa-lg fa-file-text"></i>
                        </a>
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver Informe" href="{{ route('caja.cierre.informe', $cierre->caja_id) }}">
                          <i class="m-0 fa fa-lg fa-file-text-o"></i>
                        </a>                      
                      </div>
                    </td>   
                   </tr>
                  @endforeach
                  {{-- <tr class="table-warning">
                    
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
                    
                  </tr>   --}}                
                 {{--  <tr>
                    
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
                  </tr>         --}}
                 
               
                </tbody>
              </table>
              {{ $cierres->appends( Request::only(['usuario']) )->links() }}
            </div>
        </div>
    </div>
  </div>
  

   </div>







  

@endsection

@push('scripts')
  
@endpush