@foreach ($ventas as $venta)
    <li class="d-flex justify-content-between text-row ui-sortable-handle" data-importe='{{ $venta->importe }}' data-venta-id="{{ $venta->id }}">
        {{ $venta->id }} --- {{ $venta->importe }}
        <a id="" class="eliminaRemisa" data-venta-id="{{$venta->id}}"><i class="fa fa-times"></i></a>
    </li>
@endforeach