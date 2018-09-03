@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar roles')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('seguridad/roles'))


@section('content')


<div class="row">
  <div class="col-lg-10">
    @if($notificacion=Session::get('notificacion'))
    <div class="alert alert-success">{{ $notificacion }}</div>
    @endif
    @if($notificacion_error=Session::get('notificacion_error'))
    <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
  </div>

</div>
<div class="col-12">
  <div class="tile">
    <div class="tile-body ">
      <form class="row" role="form" action="{{ route('roles.update', ($roles->id)) }}" method="POST">
       {{ csrf_field() }}
       {{ method_field('PUT') }}
       <div class="row">
        <div class="col-lg-12">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>Descripción</label>
            <input type="text" class="form-control" name="name" value="{{$roles->descripcion}}" maxlength="120" required autofocus>
          </div>
        </div>
      </div>

        <div class="col-lg-6">
         <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>Modulo</th>
              <th align="center">Autorizado</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;?>
            @foreach($autorizacion as $aut)
            <?php $i++;?>
            <tr>
              <td>{{$aut->descripcion}}</td>
              <td align="center">
                <?php $name="autorizado".$i;?>

                <input type="checkbox" class="form-check-input" id="{{$name}}" @if($aut->autorizacion==1) checked @endif >
              </td>   
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      

    <div class="row">
      <div class="col-lg-6">
        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  

      </div>
    </div>

  </form>
</div>
</div>
</div>


@endsection
@section('javascript')
<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $(".alert").slideUp(500);
    },10000)
  })
</script>
@endsection
