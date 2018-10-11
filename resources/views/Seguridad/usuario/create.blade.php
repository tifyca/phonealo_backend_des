@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nuevo Usuario')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('seguridad/usuarios'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))


@section('content')



<form role="form" action="{{ route('usuarios.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="120" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>Email(Login de Usuario)</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" maxlength="100" required>
                @if ($errors->has('email'))
                    <p class="help-block">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label>Clave</label>
                <input type="password" class="form-control" name="password" maxlength="100" required>
                @if ($errors->has('password'))
                    <p class="help-block">{{ $errors->first('password') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Confirmar Clave</label>
                <input type="password" class="form-control" name="password_confirmation" maxlength="100" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Seleccione Rol de Usuario</label>
                <select name="rol_id" id="rol_id" class="form-control">
                    <option>Seleccione Rol</option>
                 @foreach($roles as $roles)
                 <option value="{{ $roles->id }}">{{ $roles->descripcion }}</option>
                 @endforeach    
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label>Seleccione Empleado</label>
                <select name="id_empleado" id="id_empleado" class="form-control">
                    <option>Empleado</option>  
                </select>
            </div>
        </div>


    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  </div>
</form>


@endsection
 @push('scripts')
  <script type="text/javascript" language="javascript">
    $ = jQuery;
    jQuery(document).ready(function () {


     $("select#rol_id").bind('change', function (event) {
        var valor = $(this).val();
        $("#id_empleado").html('');
        $("#id_empleado").append('<option value='+'>Empleado</option>');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({
          type: "GET",
          url: '{{ url('buscar_empleados') }}',
          dataType: "json",
          data: { id_rol: valor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
            $.each(data, function(l, item1) {
             $("#id_empleado").append('<option value='+item1.id+'>'+item1.nombres+'</option>');
           });
          }    

        });

      });
 });
</script>
@endpush