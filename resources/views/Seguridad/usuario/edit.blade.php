@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar Usuario')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('seguridad/usuarios'))


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
<form role="form" action="{{ route('usuarios.update', ($usuario->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $usuario->name) }}" maxlength="120" required autofocus>
                @if ($errors->has('name'))
                    <p class="help-block">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $usuario->email) }}" maxlength="100" required readonly>
                @if ($errors->has('email'))
                    <p class="help-block">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
          <div class="col-lg-4">
            <div class="form-group">
                <label>Seleccione Rol de Usuario</label>
                <select name="rol_id" id="rol_id" class="form-control">
                    <option>Seleccione Rol</option>
                 @foreach($roles as $roles)
                 <option value="{{ $roles->id }}"
                @if(old('rol_id', $usuario->rol_id)==$roles->id) selected @endif >{{ $roles->descripcion }}</option>
                 </option>
                 @endforeach    
                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  
          
        </div>
    </div>
</form>


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
