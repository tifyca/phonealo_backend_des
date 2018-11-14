
            <div class="card-header">
                <span class="card-header-text">{{ $empleado->nombres }}</span>
            </div>
            
            <ul class="sortable ui-sortable empleado{{ $empleado->id }}" id="empleado{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}">
                @foreach ($remisa as $item)
                   @if ($item->id_delivery == $empleado->id)
                       @foreach ($ventasAsignadas as $ventaA)
                            @if ($ventaA->id == $item->id_venta)
                                <li class="text-row ui-sortable-handle" data-importe='{{ $ventaA->importe }}' data-venta-id="{{ $ventaA->id }}">{{ $ventaA->id }}---{{ $ventaA->importe }}
                                    
                                </li>
                            @endif
                       @endforeach
                   @endif
                @endforeach
            </ul>
            <div class="col-12 text-right mb-3">
                <p><b>Total: <span id="total{{ $empleado->id }}">0</span> Gs.</b></p>
                <button type="button" id="btnSaveRemito{{ $empleado->id }}" data-empleado-id="{{ $empleado->id }}" class="btn btn-primary ">Confirmar</button>
            </div>
 