 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Detalle de Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', route('caja.abrir', $caja->id))
@section('display_new','d-none')  @section('link_new', url('') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12">
    
    <div class="tile">
      <div class="row d-flex justify-content-end">
      <div class="col-3">
       <form action="">
          <div class="form-group">
                <select class="form-control" id="" name="" ">
                  <option value="">Todos los Ingresos</option>
                  <option value="">Ingresos Efectivo</option>
                  <option value="">Ingresos POS</option>}
                  <option value="">Otros Ingresos</option>}
                  <option value="">Total de Salidas</option>
                </select>
              </div>
       </form>
      </div>
    </div>
        
      
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead {{-- class="text-center" --}}>
                <tr class="table-secondary">
                  <th>Descripción</th>
                  <th>Tipo</th>
                  <th>Referencia</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody {{-- class="text-center" --}}>
               {{--  <tr>                  
                  <td>Ingresos Efectivo</td>
                  <td>Ingreso de efectivo</td>                  
                  <td> $ 95.000 </td>
                </tr>
                <tr>                  
                  <td>Ingresos POS</td>
                  <td>5899415407159006</td>                  
                  <td> $ 185.000 </td>
                </tr>
                <tr>                  
                  <td>Otros Ingreso</td>
                  <td>Cheque #123456</td>                  
                  <td> $ 15.000 </td>
                </tr>
                  <td>Salida efectivo</td>
                  <td>Pago de gasolina</td>                  
                  <td> $ 50.000 </td>
                </tr> --}}
                @foreach ($detalles as $detalle)
                  <tr>
                    <td>{{ $detalle->descripcion }}</td>
                    <td>{{ $detalle->tipo }}</td>
                    <td>{{ $detalle->referencia }}</td>
                    <td>{!!number_format($detalle->importe, 0, ',', '.')!!}</td>
                  </tr>
                @endforeach
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