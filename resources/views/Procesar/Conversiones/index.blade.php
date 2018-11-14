 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Conversiones')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('procesar/conversiones/new') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
  <div class="col-12">
    <div class="tile">
      <div class="col mb-3 text-center ">
          <div class="row d-flex justify-content-end">
            <div class="form-group col-md-2">
              <input type="date" class="form-control" name="">
            </div>
            <div class="form-group col-md-2">
              <input type="date" class="form-control" name="">
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Estatus</option>
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
          <div class="col-12  my-4 table-responsive">
            <table class="table">
              <thead>
                <tr> 
                  <th>Status</th>
                  <th>Nombre de Lista</th>
                  <th>Cant. Productos</th>
                  <th>Gastos publicidad</th>
                  <th>Ventas unitarias</th>
                  <th>Total Ventas</th>
                  <th>Utilidad bruta</th>
                  <th>ROI</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr> 
                  <td>Status</td>
                  <td>Nombre de Lista</td>
                  <td>Cant. Productos</td>
                  <td>500000</td>
                  <td>Ventas unitarias</td>
                  <td>Total Ventas</td>
                  <td>Utilidad bruta</td>
                  <td>ROI</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('procesar.conversiones.show') }}" class="btn btn-primary" title="Ver"><i class="m-0 fa fa-lg fa-eye"></i></a>
                      <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="{{ route('procesar.conversiones.editar',4) }}"><i class="m-0 fa fa-lg fa-pencil"></i></a>
                            <a href="" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                 <tr> 
                  <td>Status</td>
                  <td>Nombre de Lista</td>
                  <td>Cant. Productos</td>
                  <td class="text-center">
                    <div class="row d-flex justify-content-center btn-group">
                      <input type="text" class="form-control  col-9" style="border-radius: 4px 0px 0px 4px " placeholder="Monto" name="">
                      <a class="btn btn-primary col-2" href=""><i class="m-0 fa fa-lg fa-check"></i></a>
                    </div>
                    
                  </td>
                  <td>Ventas unitarias</td>
                  <td>Total Ventas</td>
                  <td>Utilidad bruta</td>
                  <td>ROI</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('procesar.conversiones.show') }}" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-eye"></i></a>
                      <a href="" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a href="" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                <tr> 
                  <td>Status</td>
                  <td>Nombre de Lista</td>
                  <td>Cant. Productos</td>
                  <td>500000</td>
                  <td>Ventas unitarias</td>
                  <td>Total Ventas</td>
                  <td>Utilidad bruta</td>
                  <td>ROI</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('procesar.conversiones.show') }}" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-eye"></i></a>
                      <a href="" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a href="" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                 <tr> 
                  <td>Status</td>
                  <td>Nombre de Lista</td>
                  <td>Cant. Productos</td>
                  <td class="text-center">
                    <div class="row d-flex justify-content-center">
                      <input type="text" class="form-control col-9" style="border-radius: 4px 0px 0px 4px " placeholder="Monto" name="">
                      <a class="btn btn-primary col-2" href=""><i class="m-0 fa fa-lg fa-check"></i></a>
                    </div>
                  </td>
                  <td>Ventas unitarias</td>
                  <td>Total Ventas</td>
                  <td>Utilidad bruta</td>
                  <td>ROI</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('procesar.conversiones.show') }}" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-eye"></i></a>
                      <a href="" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a href="" class="btn btn-primary" title=""><i class="m-0 fa fa-lg fa-trash"></i></a>
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