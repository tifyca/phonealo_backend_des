@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Descompuestos')
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
              <h3 class="tile-title text-center text-md-left">Listado de Descompuestos</h3>
            </div>
            <div class="col-md-2 mr-md-3">
              <button class="btn btn-primary" data-toggle="modal" data-target="#ModalDescompuesto" type="" onclick="reparartodo()"><i class="fa fa-lg fa-eye"></i>Enviar Seleccionados</button>
            </div>
          </div>
        </div>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th width="5%" class="text-center"><input type="checkbox" class="form-control select-all" name="ch" value="" ></th>
                    <th  class="text-center">N° Caso</th>
                    <th  class="text-center">Fecha Cambio</th>
                    <th  class="text-center">Fecha Pedido</th>
                    <th  class="text-center">Producto</th>
                    <th  class="text-center">Nota</th>
                    <th  class="text-center">Valor</th>
                    <th  class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($descompuesto as $item)       
                 
                 @if($item->status_soporte == 3)
                    <tr style="background-color: orange;" >
                      <td width="5%" class="text-center"></td>
                      <td>{{$item->idsoporte}}</td>
                      <td>{{$item->fecha}}</td>
                      <td>{{$item->fecha_activo}}</td>
                      <td>{{$item->descripcion}}</td>
                      <td>{{$item->nota}}</td>
                      <td>{!!number_format($item->precio_compra, 0, ',', '.')!!}</td>
                      <td width="10%" class="text-center" ><img title="Sin Poder Reparar" src="{{asset('img/wrench.png')}}"></td>
                     </tr>
                  @else
                  <tr>
                    <td width="5%" class="text-center"><input type="checkbox" class="form-control chk-box" name="ch"   value="{{$item->idsoporte}}"></td>
                    <td>{{$item->idsoporte}}</td>
                    <td>{{$item->fecha}}</td>
                    <td>{{$item->fecha_activo}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>{{$item->nota}}</td>
                    <td>{!!number_format($item->precio_compra, 0, ',', '.')!!}</td>
                    <td width="10%" class="text-center">
                    <div class="btn-group">
                      <a class="btn btn-primary" title="Soporte" data-toggle="modal" data-target="#ModalDescompuesto" href="#" onclick="reparar({!!$item->idsoporte!!})"><i class="m-0 fa fa-lg fa-wrench"></i></a> 
                    </div>
                    </td>
                  </tr>
                  @endif
                  @endforeach

                </tbody>
              </table>
            </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalDescompuesto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporte de Descompuestos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe width="100%" height="500px" src="{{ asset('archivos/pdf.pdf') }}"></iframe>
      </div>
    </div>
  </div>
</div>
{{--  --}}

  

@endsection

@push('scripts')
<script type="text/javascript">
  
  $('document').ready(function(){
 
    $(".select-all").click(function (){
          $('.chk-box').attr('checked', this.checked)
         });
  
     $(".chk-box").click(function(){
        if($(".chk-box").length == $(".chk-box:checked").length) 
        {
         $(".select-all").attr("checked", "checked");
        }else{
         $(".select-all").removeAttr("checked");
        }
    });
});

function reparartodo(){
        var id = [];
        var cb = [];
        var n=0,cuales="";
        cb = document.getElementsByName('ch');
        // alert('El total de checkbox de name = ' + f1 + ' es: ' + cb.length);
            for (var i = 0; i < cb.length; i++){
            var e = parseInt(i);
            // alert('Valor del checkbox ' + (e+1) + ': ' + cb[i].value);
                if(cb[i].checked == true){
                cuales += cb[i].value;
                n++;


                id.push(cb[i].value);
                }
            } // fin loop
var data = JSON.stringify(id);
alert(data);
/*
  new Ajax.Request('update_desctodos.php', {method:'post', parameters: {data: data//capturo array 
  },
        onSuccess: function(resp){
            alert("Este producto ha sido enviado a reparación");
                window.open("rpt_soportetodos.php?id="+data, "_blank");
               location.reload();
        
        }*/

   };

function reparar(id_soporte){
    var id = id_soporte;

    alert(id);

  /*  new Ajax.Request('update_desc.php', {method:'post', parameters: {id: id},
        onSuccess: function(resp){
            id = resp.request.body;
            // window.location.href = "rpt_soporte.php?id="+id;

            alert("Este producto ha sido enviado a reparación");
             window.open('rpt_soporte.php?id='+id, '_blank');
             // location.reload();
             ver_descompuestos();
        
        }
    });*/

}
/*
  $id_soportea = $_POST['id'];
// var_dump($_POST['id'];
// var_dump($_POST['n']);
 $id=array();

$data = json_decode($_POST['data']);
// $a= count($_POST['data'];
// var_dump($a);

for ($i=0; $i < count($data); $i++) { 
          
  $id_soporte= $data[$i];
  $db = new Database(); 
  $db->query("UPDATE soporte SET status_soporte = '2' WHERE id_soporte = '$id_soporte'");
  $db->execute();
  $id=$id_soporte;

}

$prueba = serialize($id);


header("location:rpt_soportetodos.php?id=$prueba");




}

$id_soporte = $_POST['id'];
        $db = new Database(); 


          $db->query("UPDATE soporte SET status_soporte = '2' WHERE id_soporte = '$id_soporte'");
          $db->execute();
*/
</script>
@endpush