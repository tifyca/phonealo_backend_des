@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Usuario')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')

@section('display_new','')  @section('link_new', url('seguridad/usuarios/create') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

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



<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nombre</th>
                            <th>Registro</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr>

                            <td><a href="{{ route('usuarios.edit', ($usuario->id) ) }}" title="Editar">{{ $usuario->email }}</a></td>
                            <td><a href="{{ route('usuarios.edit', ($usuario->id) ) }}" title="Editar">{{ $usuario->name }}</a></td>
                            <td>{{ $usuario->created_at }}</td>
                         <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('usuarios.edit', $usuario->id ) }}" title="Editar Registro"><i class="fa fa-lg fa-eye"></i></a>
                         <?php 
                                $valor = $usuario->id; 
                                $url="seguridad/usuarios/cambiar/".$valor; ?>
                        <a class="btn btn-primary" href="{{ url($url) }}" title="Cambiar Contraseña"><i class="fa fa-fw fa-key"></i></a>
                        <a class="btn btn-primary" href="{{ route('usuarios.destroy',$usuario->id) }}" title="Eliminar Registro"><i class="fa fa-trash" onclick="return confirm('¿Seguro desea eliminar este registro?')"></i></a>
                                
                    

                      </div>
                    </td>

                                
                                

                        </tr>
                    @endforeach                </tbody>
                </table>
                <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $usuarios->render(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection