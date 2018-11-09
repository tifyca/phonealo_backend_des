@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'A Confirmar')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
@php $longitud=count($notaventa); @endphp

<div class="row">
  <div class="col-12">
    <div class="tile ">
      <h3 class="tile-title text-center text-md-left">Clientes por Atender <small>(48 hr. Sin Respuesta)</small> </h3>
      <div class="tile-body ">
        <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Vendedor</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <tr class="table-danger">
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Barrio</td>
                    <td>Fecha</td>
                    <td>Estado</td>
                    <td>Vendedor</td>
                    <td>Importe</td>
                    
                     <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modalCliente" href="#"><i class="m-0 fa fa-lg fa-phone"></i></a>
                      </div>
                    </td>
                  </tr>  
                  
                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Clientes por Confirmar</h3>
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="text" id="" name="" placeholder="Venta">
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="date" id="" name="" >
            </div>
            <div class="form-group col-md-2">
               <select class="form-control" id="vendedor" name="vendedor" >  
                <option value="">Vendedor</option>
                @foreach($vendedor as $item2)
                <option value="{{$item2->id}}">{{$item2->name }}</option>     
                @endforeach        
              </select>
            </div>
          </div>
        </div>
        <div class="tile-body ">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Vendedor</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $total = 0; ?>
                  @foreach($aconfirmar as $item)
                  <tr>
                    <td class="venta"   <?php $x=0; ?>
                                          @for($i=0; $i<$longitud; $i++)
                                            @if($item->id==$notaventa[$i]->id_venta)
                                               <?php $x=$x+1; ?>
                                                  @if($x==1)
                                                     data-id="{{$item->id}}"
                                                  @endif
                                            @endif
                                          @endfor  style="text-align: center;">{{$item->id}}    
                                     <?php $x=0; ?>
                                  @for($i=0; $i<$longitud; $i++)
                                    @if($item->id==$notaventa[$i]->id_venta)
                                     <?php $x=$x+1; ?>
                                     @if($x==1)
                                       &spades;
                                     @endif
                                    @endif
                                  @endfor
                                  <div class="toolTip" id="{{$item->id}}" style="display: none;">
                              @foreach($nota as $itemn)
                                @if($itemn->id_venta==$item->id)
                                   <table style="border:0px; width: 850px; font-size: 12px; ">
                                    <td style="border:0px; text-align: left; width: 140px;">{{$itemn->fecha}}</td>
                                    <td style="border:0px; text-align: left; width: 110px;">{{$itemn->nombre}}</td>
                                    <td style="border:0px; text-align: left;">{{$itemn->nota}}</td>
                                   </table>
                                @endif
                              @endforeach
                                  </div>
                                          </td>
                    <td>{{$item->nombres}}</td>
                    <td>{{$item->telefono}}</td>
                    <td>{{$item->direccion}}</td>
                    <td>{{$item->barrio}}</td>
                    <td>{{$item->fecha}}</td>
                    <td>{{$item->estado}}</td>
                    <td>{{$item->name}}</td>
                    <td>{!!number_format($item->importe, 0,',', '.')!!}</td>
                    
                     <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modalCliente" href="#"><i class="m-0 fa fa-lg fa-phone"></i></a>
                      </div>
                    </td>    
                  </tr>
                  <?php $total += $item->importe; ?>
                  @endforeach
                  <tr>
                    <td colspan="8" class="text-right">
                      <h4>Total Gs.:</h4>
                    </td>
                    <td colspan="2">
                     <h4>{!!number_format($total, 0,',', '.')!!}</h4>
                    </td>
                  </tr>
        
 
                 
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
  
{{--    <div class="col-4 sticky-top" >
      <div class="tile " >
        <h3 class="tile-title text-center text-md-left">Productos</h3>
          <div class="tile-body ">
            <div class="row border-top ">
              <div class="col-md-6 my-3">
                <p><b>Producto:</b> Barbeador Recargable Resistente al agua - 4x1</p>
                <div class="btn-group">
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-refresh"></i></a>
                </div>
              </div>
              <div class="col-md-6 my-3">
                <p><b>Cod.:</b> 087609</p>
                <p><b>Cantidad:</b> 00</p>
                <p><b>Precio:</b> 09879</p>
              </div>
            </div>
             <div class="row border-top ">
              <div class="col-md-6 my-3">
                <p><b>Producto:</b> Barbeador Recargable Resistente al agua - 4x1</p>
                <div class="btn-group">
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-refresh"></i></a>
                </div>
              </div>
              <div class="col-md-6 my-3">
                <p><b>Cod.:</b> 087609</p>
                <p><b>Cantidad:</b> 00</p>
                <p><b>Precio:</b> 09879</p>
              </div>
            </div>
             <div class="row border-top ">
              <div class="col-md-6 my-3">
                <p><b>Producto:</b> Barbeador Recargable Resistente al agua - 4x1</p>
                <div class="btn-group">
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
                  <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-refresh"></i></a>
                </div>
              </div>
              <div class="col-md-6 my-3">
                <p><b>Cod.:</b> 087609</p>
                <p><b>Cantidad:</b> 00</p>
                <p><b>Precio:</b> 09879</p>
              </div>
            </div>
            </div>
          </div>
      </div> --}}
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table ">
            <thead>
              <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Código</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
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
{{--  --}}

<!-- Modal -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acción de Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 d-flex justify-content-between">
            <a href="#" class="btn btn-secondary" title=""><i class="fa fa-lg fa-times"></i>Venta Caida</a>
            <a href="#" class="btn btn-primary" title=""><i class="fa fa-lg fa-check"></i>Venta Confirmada</a>
          </div>
          <div class="col-12 mt-3 border-top">
            <form action="" method="get" accept-charset="utf-8">
              <div class="form-group mt-3">
                <label for="exampleFormControlTextarea1">Respuesta del Cliente</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
              <button type="button" class="btn btn-primary">Enviar</button>
            </form>
          </div>
        </div>
        

        

      </div>
     
    </div>
  </div>
</div>


  

@endsection

@push('scripts')

<script type="text/javascript">

$(document).ready(function(){
   
    $('.venta').hover(function () {
         var data_id = $(this).data('id');

    
       $('.toolTip').each(function() {
           var div = $(this);

          if(div.attr('id') == data_id){
              div.show();
          }else{
            div.hide();
          }

      }); 
           
    },

    function () { $('.toolTip').css("display","none");}
   );
   
});

</script>

@endpush