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
<style>
body {
    font-family: arial;
}
h1 {
    font-weight: normal;
}
.task-board {
    background: #2c7cbc;
    display: inline-block;
    padding: 12px;
    border-radius: 3px;
    width: 100%;
    white-space: nowrap;
    overflow-x: scroll;
    min-height: 300px;
}

.status-card {
    width: 250px;
    margin-right: 8px;
    background: #e2e4e6;
    border-radius: 3px;
    display: inline-block;
    vertical-align: top;
    font-size: 0.9em;
}

.status-card:last-child {
    margin-right: 0px;
}

.card-header {
    width: 100%;
    padding: 10px 10px 0px 10px;
    box-sizing: border-box;
    border-radius: 3px;
    display: block;
    font-weight: bold;
}

.card-header-text {
    display: block;
}

ul.sortable {
    padding-bottom: 10px;
}

ul.sortable li:last-child {
    margin-bottom: 0px;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0px;
}

.text-row {
    padding: 8px 10px;
    margin: 10px;
    background: #fff;
    box-sizing: border-box;
    border-radius: 3px;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
    font-size: 0.8em;
    white-space: normal;
    line-height: 20px;
}

.ui-sortable-placeholder {
    visibility: inherit !important;
    background: transparent;
    border: #666 2px dashed;
}
</style>
<div class="task-board">
    <div class="status-card">
        <div class="card-header">
            <span class="card-header-text">Ventas</span>
        </div>
        
        <ul class="sortable ui-sortable" id="empleado0" data-empleado-id="0">
            @foreach ($ventas as $venta)
                <li class="text-row ui-sortable-handle" data-importe='{{ $venta->importe }}' data-venta-id="{{ $venta->id }}">{{ $venta->id }} --- {{ $venta->importe }}</li>
            @endforeach
            
        </ul>
    </div>
    
    @foreach ($empleados as $empleado)
        <div class="status-card">
            <div class="card-header">
                <span class="card-header-text">{{ $empleado->nombres }}</span>
            </div>
            
            <ul class="sortable ui-sortable empleado{{ $empleado->id }}" id="empleado{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}">
                @foreach ($remisa as $item)
                   @if ($item->id_delivery == $empleado->id)

                   @foreach ($ventas as $venta)

                        @if ($venta->id == $item->id_venta)
                            <li class="text-row ui-sortable-handle" data-importe='{{ $venta->importe }}' data-venta-id="{{ $venta->id }}">{{ $venta->id }}---{{ $venta->importe }}</li>
                        @endif
                       
                   @endforeach
                  
                        

                   @endif
                @endforeach



                
            </ul>
            <div class="col-12 text-right mb-3">
                   {{--  @foreach ($remisa as $item)
                    @if ($item->id_delivery == $empleado->id)
                    @foreach ($ventas as $venta)
                    @if ($venta->id == $item->id_venta)
                          
                    @endforeach
                    @endif
                    @endforeach --}}

                    <p><b>Total: <span id="total{{ $empleado->id }}"></span> Gs.</b></p>
                    <button type="button" id="btnSaveRemito{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}" class="btn btn-primary ">Confirmar</button>
                </div>
        </div>
    @endforeach
</div>

@endsection

@push('scripts')

 <script>

$(function() {

        var url = '{{ route('saveRemisa') }}';
        $('ul[id^="empleado"]').sortable(
                {

                    cursor: "move",
                    connectWith : ".sortable",
                    receive : function(e, ui) {


                        var empleado_id = $(ui.item).parent(".sortable").data(
                                "empleado-id");
                        var venta_id = $(ui.item).data("venta-id");
                       
                        //console.log(empleado_id);
                        //console.log(venta_id);
                        
                        $.ajax({
                            type: "get",
                            url: url+'/'+empleado_id+'/'+venta_id,
                            dataType: "json",
                            data: { empleado_id: empleado_id, venta_id:venta_id },
                            success : function(response) {

                                var montos = [];
                                $('.empleado'+empleado_id+' li').each(function () {
                                    montos.push ($(this).data('importe'))
                                });

                                    var suma = 0;
                                    for(var x = 0; x < montos.length; x++){
                                      suma += montos[x];
                                    } 
                                    $('#total'+empleado_id).html('');       
                                    $('#total'+empleado_id).html(suma);
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
         
            });

               

        });
    });
 </script>

 <script type="text/javascript" charset="utf-8" async defer>
     
 </script>
@endpush
