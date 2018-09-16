@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Confirmación de Solicitud de Pedido')
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
      <form name="form1" action="{{route('entradas.carga')}}" accept-charset="UTF-8"  method="post">
            {{ csrf_field() }}
          <div class="row">
            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha</label>
              <input class="form-control" type="date" id="fecha_entrada" name="fecha_entrada" required="" value="{{$solped->fecha}}" readonly="">
            </div>
            <div class="form-group col-md-3">
              <input type="hidden" id="idsolped" name="idsolped" value="{{$solped->id}}">
              <label for="n_documento_entrada">Número de Documento</label>
              <input class="form-control" type="text" id="nro_documento" name="nro_documento" placeholder="..." readonly="" maxlength="30" value="{{$solped->nro_documento}}">
            </div>
            <div class="form-group col-md-3">
              <label for="proveedor_entrada">Proveedor</label>
              <select class="form-control" id="id_proveedor" name="id_proveedor" readonly>
                <option value="">Proveedor</option>
                @foreach($proveedores as $provee)
                <option value="{{$provee->id}}" @if($solped->id_proveedor==$provee->id) selected="" @endif>{{$provee->nombres}}</option>
                @endforeach
              </select>

            </div>
           <div class="form-group col-md-6">
              <label for="n_documento_entrada">Observaciones</label>
              <textarea name="observaciones" class="form-control" id="observaciones" cols="60" rows="3"></textarea>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="tile">
        <div class="tile-body ">
          <div class="table-responsive">
            <table id="detalles" class="table">
              <thead>
                <tr>
                  <td><b>Cod.</b></td>
                  <td><b>Producto</b></td>
                  <td><b>Cantidad</b></td>
                  <td><b>Precio</b></td>
                  <td><b>Importe</b></td>
                  <td><b>Cantidad(Conf)</b></td>
                  <td><b>Precio(Conf)</b></td>
                  
                </tr>
               </thead>
              <tbody>
                <?php $total=0; $z=1; 
                $name3="idproducto"+$z;
                $name="cantidad_conf"+$z;
                 $name2="precio_conf"+$z;
                ?>
                @foreach($detalles as $det)
                <tr>
                  <input type="hidden" name="idproducto[]" id="{{$name3}}" value="{{$det->idproducto}}">
                  <td>{{$det->codigo}}</td>
                  <td>{{$det->desprod}}</td>
                  <td align="center">
                    <?php $cant=$det->cantidad;
                      $zcan = number_format($cant, 0, ',', '.');
                      echo $zcan;?>
                        
                  </td>
                  <td align="right">
                    <?php $prec=$det->precio;
                      $zcan = number_format($prec, 2, ',', '.');
                      echo $zcan;?>
                    
                  </td>
                  <td><?php $importe=$det->precio*$det->cantidad;
                      $ztotal = number_format($importe, 2, ',', '.');
                      $total = $total + $importe;
                     echo $ztotal;$z++;
                    $name="cantidad_conf"+$z;
                    $name2="precio_conf"+$z;
                    $name3="idproducto"+$z;
                     ?></td>
                  <td><input type="text" name="cantidad_conf[]" id="{{$name}}"></td>
                  <td><input type="text" name="precio_conf[]" id="{{$name2}}"></td>
                </tr>
                @endforeach
              </tbody>
              </tbody>
               <tr class="table-secondary">
                    <td  colspan="4" class="text-right"><b>Total Importe</b></td>
                    <td  id="ztotal">
                    <?php 
                      $ztotal = number_format($total, 2, ',', '.');
                      
                     echo $ztotal;?>
                      

                    </td>
                    <td  align="right" colspan="2">
                    <?php 
                      $ztotal = number_format($total, 2, ',', '.');
                      
                     echo $ztotal;?>
                      

                    </td>
                  </tr>
            </table>
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
<script type="text/javascript" charset="utf-8" async defer>

    $ = jQuery;
    jQuery(document).ready(function () {
     $("input#cantidad_conf").bind('keydown', function (event) {

      if(event.shiftKey)
      {
        event.preventDefault();
      }
      if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 241 )    {
      }
      else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
          }
        } 
        else {
          if (event.keyCode < 96 || event.keyCode > 105) {
            event.preventDefault();
          }
        }
      }        
      ;
    });    

     $("input#precio_conf").bind('keydown', function (event) {

      if(event.shiftKey)
      {
        event.preventDefault();
      }
      if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 241 )    {
      }
      else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
          }
        } 
        else {
          if (event.keyCode < 96 || event.keyCode > 105) {
            event.preventDefault();
          }
        }
      }        
      ;
    });    
});
 </script>


 @endpush