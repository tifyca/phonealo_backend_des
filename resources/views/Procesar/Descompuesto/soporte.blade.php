@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Descompuestos - Soporte')
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
        <h3 class="tile-title">Listado de Soporte</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>N° Caso</th>
                    <th>Fecha Cambio</th>
                    <th>Fecha Pedido</th>
                    <th>Producto</th>
                    <th>Valor</th>
                    <th>Nota</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
               @foreach($soporte as $item) 
                  <tr>
                    <td>{{$item->idsoporte}}</td>
                    <td>{{$item->fecha}}</td>
                      <td>{{$item->fecha_activo}}</td>
                      <td>{{$item->descripcion}}</td>
                      <td>{!!number_format($item->precio_compra, 0, ',', '.')!!}</td>
                      <td>{{$item->nota}}</td>
                    <form action="">
                      <td width="20%">
                        <div class="row">
                          <div class="form-group col-7 m-0">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" value="3" type="radio" name="status_sop" id="status_sop">Sin reparar
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                   <input class="form-check-input" value="4" type="radio" name="status_sop" id="status_sop">Reparado
                                </label>
                              </div>
                            </div>
                          <div class="btn-group col-3">
                            <button  class="btn btn-primary" type="submit"  onclick="reparado({!!$item->idsoporte!!})"><i class="m-0 fa fa-lg fa-check"></i></button>
                          </div>
                        </div>
                      </td>
                    </form>
                  </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
            </div>
        </div>
    </div>
  </div>
</div>


  

@endsection

@push('scripts')
  <script type="text/javascript">
    
function reparado(id_soporte){
    var id = id_soporte;
    var status_sop = document.getElementById('status_sop').value;

    alert(id);
    alert(status_sop);
}
/*
    new Ajax.Request('update_rep.php', {method:'post', parameters: 
        {
            id: id, 
            status_sop: status_sop
        },
        onSuccess: function(resp){
            if(status_sop == 3){
                alert("Este producto no se pudo reparar");    
            }else if(status_sop == 4){
                alert("Este producto ha sido reparado");
                
            }
       
                // location.reload();
                soporte();
        }
    });


id = $_POST['id'];
$status = $_POST['status_sop'];
$cantidad="1";
$precio="0";
$hoy=date('Y-m-d');
$id_usuario = isset($_SESSION['id_usu']) ? $_SESSION['id_usu'] : '';
        $db = new Database(); 

          $db->query("SELECT id_producto FROM soporte WHERE id_soporte = '$id'");
          $result = $db->resultset();

          $id_producto= $result[0]['id_producto'];

          $db->query("UPDATE soporte SET status_soporte = '$status', fecha_eg='$hoy' WHERE id_soporte = '$id'");
          $db->execute();


  
  $db->query("UPDATE productos a SET a.stock_activo = a.stock_activo+1, a.descompuesto = a.descompuesto-1 wERE a.id_producto = '$id_producto' ")
      
  $db->execute();


   $db->query("INSERT INTO carga_producto (id_usuario, id_producto, cantidad, precio, fecha,estado) VALUES ('$id_usuario', '$id_producto', '$cantidad', '$precio', CURDATE(), 'Reparado')");
   */
  </script>
@endpush