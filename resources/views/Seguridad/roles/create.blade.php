@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Rol')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('seguridad/roles'))


@section('content')



<form role="form" action="{{ route('roles.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" maxlength="120" required autofocus>
                @if ($errors->has('descripcion'))
                    <p class="help-block">{{ $errors->first('descripcion') }}</p>
                @endif
            </div>
        </div>
    
    </div>
      <div class="tile">
        <h3 class="tile-title text-center text-md-left">Resumen de Autorizaciones</h3>
        <div class="tile-body ">
          <div class="table-responsive">
             <input type="hidden" id="ListaProd1" name="Lista_autorizaciones" value="" required />
            <table id="detalles" class="table">
              <thead>
                <tr>
                  <td><b>#</b></td>
                  <td><b>Autorización</b></td>
                  <td><b>Permitido</b></td>
                </tr>

                <?php 
                 $contador=0;
                 $n1 = "autoriz[".$contador."][id]";
                 $n2 = "autoriz[".$contador."][permitido]";

                ?>
                @foreach($autorizaciones as $autorizar)
                <tr>
                    <td><?php echo $contador+1;?></td>
                                    <td>
                      <input type="text" class="form-control" name="{{$n1}}" id="{{$n1}}" value="<?php echo $autorizar->descripcion;?>" size="16" disabled>

                </td>
                <td>
                     <input type="checkbox" class="form-check-input" name="">
                </td>

                </tr>
                <?php $contador++;?>
                @endforeach
            </thead>
        </table>
    </div>
</div>
</div>


    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  </div>
</form>


@endsection
