@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Monitoreo de Remitos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="task-board  ">
    <div class="status-card">
        <div class="card-header">
            <span class="card-header-text">Ventas</span>
        </div>
        
        <ul class="sortable ui-sortable "  id="empleado0" data-empleado-id="0">
          {{--  @include('Logistica.remisa.ventas6')  --}}
           
        </ul>
    </div>
    
    @foreach ($empleados as $empleado)
        <div class="status-card" id="card_delivery">
            <div class="card-header">
                <span class="card-header-text">{{ $empleado->nombres }}</span>
            </div>
            
            <ul class="sortable ui-sortable emple empleado{{ $empleado->id }}" id="empleado{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}">
                @foreach ($remisa as $item)
                   @if ($item->id_delivery == $empleado->id)
                       @foreach ($ventasAsignadas as $ventaA)
                            @if ($ventaA->id == $item->id_venta)
                                <li style="@if ($ventaA->id_estado == 7) background: silver; @endif" class="text-row li{{ $ventaA->id }} ui-sortable-handle" data-importe='{{ $ventaA->importe }}' data-venta-id="{{ $ventaA->id }}">{{ $ventaA->id }}---{{ $ventaA->importe }}
                                    
                                </li>
                            @endif
                       @endforeach
                   @endif
                @endforeach
            </ul>
            <div class="col-12 text-right mb-3">
                <p><b>Total: <span class="total" id="total{{ $empleado->id }}">0</span> Gs.</b></p>
                <button type="button" id="btnSaveRemito{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}" class="btn btn-primary ">Confirmar</button>
            </div>
        </div>
    @endforeach  

</div>

@endsection

@push('scripts')

 <script>


function addCommas(nStr) { 
    nStr += ''; 
    var x = nStr.split('.'); 
    var x1 = x[0]; 
    var x2 = x.length > 1 ? '.' + x[1] : ''; 
    var rgx = /(\d+)(\d{3})/; 
    while (rgx.test(x1)) { 
     x1 = x1.replace(rgx, '$1' + '.' + '$2'); 
    } 
    return x1 + x2; 
} 


function ventas(){
    $.ajax({
        type: "get",
        url: '{{ route('remisa0') }}',
        dataType: "json",
        success : function(response) {
        var montos = [];                      
        $.each( response.ventas, function(row, items){

            $('#empleado0').append('<li class="d-flex justify-content-between text-row ui-sortable-handle" data-importe="'+items.importe+'" data-venta-id="'+items.id+'">'+items.id+'<a id="" class="eliminaRemisa" data-venta-id="'+items.id+'"><i class="fa fa-times"></i></a></li>')

            // //console.log(items.id);
            // $('.empleado'+items.id+' li').each(function () {
            //     montos.push ($(this).data('importe'))
            // });   

        });
            
        }
    });
}

$(document).ready(ventas);   

$(function() {

        var url = '{{ route('saveRemisa') }}';
        $('ul[id^="empleado"]').sortable(
                {
        cursor: "move",
        scrollSensitivity: 1,
        connectWith : ".sortable",
        receive : function(e, ui) {
            var empleado_id = $(ui.item).parent(".sortable").data("empleado-id");
            var venta_id = $(ui.item).data("venta-id");
            var sender = ui.sender.data("empleado-id");
           
            $.ajax({
                type: "get",
                url: url+'/'+empleado_id+'/'+venta_id,
                dataType: "json",
                data: { empleado_id: empleado_id, venta_id:venta_id },
                success : function(response) {

                    var montos = [];
                    var montos2 = [];
                    var suma = 0;
                    var suma2 = 0;

                    //CALCULA LOS REGISTROS EN LA TARJETA QUE RECIBE
                    $('.empleado'+empleado_id+' li').each(function () {
                        montos.push ($(this).data('importe'))
                    });
                    for(var x = 0; x < montos.length; x++){
                      suma += montos[x];
                    } 
                    $('#total'+empleado_id).html('');  
                    var total = addCommas(suma);        
                    $('#total'+empleado_id).html(total);

                    //CALCULA LOS REGISTROS DE LA TARJETA QUE ABANDONA
                    $('.empleado'+sender+' li').each(function () {
                        montos2.push ($(this).data('importe'))
                    });
                    for(var x = 0; x < montos2.length; x++){
                      suma2 += montos2[x];
                    } 
                    $('#total'+sender).html('');  
                    var total2 = addCommas(suma2);     
                    $('#total'+sender).html(total2);
                    
                }
            });
        }

    }).disableSelection();

        $('button[id^="btnSaveRemito"]').on('click',function(){
            var empleado_id = $(this).data('empleado-id');
            var ventas = [];
            var montos = [];
            
            $('.empleado'+empleado_id+' li').each(function () {
                ventas.push  ($(this).data('venta-id')); 
                montos.push ($(this).data('importe'));
         
            });
            console.log(montos);

             var suma = 0;
            for(var x = 0; x < montos.length; x++){
              suma += montos[x];
            } 
            $('#total'+empleado_id).html('');       
            $('#total'+empleado_id).html(suma);

            console.log(ventas);
            $.ajax({
                type: "get",
                url: '{{ route('saveRemito') }}',
                dataType: "json",
                data: { id_delivery: empleado_id, suma:suma, ventas:ventas, montos:montos },
                success : function(response) {
                    console.log(response); 

                    
                }
            });




        });

        $(document).on('click','.eliminaRemisa', function(){ 
            var venta_id = $(this).data('venta-id');
             $.ajax({
                type: "get",
                url: '{{ route('destroyRemisa') }}' ,
                dataType: "json",
                data: { venta_id:venta_id },
                success : function(response) {
                  if (response == 1) {
                    $('#empleado0').html('');
                    ventas(); 
                  }
                }
            });
        });
    });
 </script>

 <script type="text/javascript" charset="utf-8" async defer>
     
 </script>
@endpush
