@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', ' Gastos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/gastos/show')) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
@if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif    
<div class="row">
  
  <div class="col-12">
    <div class="tile">
      <div class="col mb-2 text-center">
        <div class="col">
              <h4 class="tile-title text-center text-md-left">Listado de Gastos</h4>
            </div>
          <div class="row">
            
            <br>

             <form class="row" action="{{route('productos.index')}}" method="get"> 
              <div class="form-group col-md-3">
              <select class="form-control" id="id_categoria" name="id_categoria" ">
                <option value="">Categoría</option>
                @foreach($categorias as $cate)
                <option value="{{$cate->id}}">{{$cate->categoria}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="id_subcategoria" name="id_subcategoria">
                <option value="">Usuario</option>
                @foreach($usuarios as $us)
                <option value="{{$us->id}}">{{$us->name}}</option>
                @endforeach                
              </select>
            </div>
          <div class="form-group col-md-3">
              <input type="date" class="form-control" name="fecha_inicio">
            </div>
            <div class="form-group col-md-3">
              <input type="date" class="form-control" name="fecha_fin">
            </div>            
            <div class="form-group col-md-1">
              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              
            </div>
            </form>
     
          </div>
        </div>
        <div class="tile-body ">
          <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Comprobante</th>
                    <th>Categoría</th>
                    <th>Fuente</th>
                    <th>Importe</th>
                    <th>Divisa</th>
                    <th>Usuario</th>
                    <th>Fecha de Comprobante</th>
                    <th>Fecha de Carga</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($gastos as $gast)
                  <tr>
                    <td>{{$gast->descripcion}}</td>
                    <td>{{$gast->comprobante}}</td>
                    <td>
                       @foreach($categorias as $categoria)
                      @if($categoria->id==$gast->id_categoria)
                         {{$categoria->categoria}}
                      @endif
                     @endforeach
                    </td>
                    <td>{{$gast->id_fuente}}</td>
                    <td>{{$gast->importe}}</td>
                    <td>{{$gast->id_divisa}}</td>
                    <td>{{$gast->id_usuario}}</td>
                    <td>{{$gast->fecha_comprobante}}</td>
                    <td>{{$gast->fecha}}</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('gastos.edit',$gast->id) }}"><i class="fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
             <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $gastos->render(); ?>
              </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush