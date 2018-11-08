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
                    @if($item->fecha=="")
                      <td>-----------</td>
                      @else
                      <td>{{$item->fecha}}</td>
                      @endif
                      @if($item->fecha_activo=="")
                      <td>----------</td>
                      @else
                      <td>{{$item->fecha_activo}}</td>
                      @endif
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
                                   <input class="form-check-input" value="4" type="radio" name="status_sop" id="status_sop2">Reparado
                                </label>
                              </div>
                            </div>
                          <div class="btn-group col-3">
                            <button class="btn btn-primary soporte" value="{{$item->idsoporte}}"><i class="m-0 fa fa-lg fa-check"></i></button> 
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
    
 $('.soporte').click(function(e){
    var id = $(this).val(); 
    var status_sop = $('input:radio[name=status_sop]:checked').val();
   
  e.preventDefault();

    $.ajax({
        type: "GET",
        url: '{{ route('getSoporte') }}',
        dataType: "json",
        data: { status_sop:status_sop, id:id, _token: '{{csrf_token()}}'},

        success: function (data){
       
      
            if(data.status_soporte == 3){

              $("#res").html("Producto No Se Pudo Reparar.");
              $("#res, #res-content").css("display","block");
              $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                   
            }else if(data.status_soporte == 4){

               $("#res").html("Producto Ha Sido Reparado.");
               $("#res, #res-content").css("display","block");
               $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                
            }
            window.setTimeout(function(){
              location.reload()
            },2000);
        }

    });





});

  </script>
@endpush