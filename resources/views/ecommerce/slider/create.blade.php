@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Slider')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('ecommerce/slider'))
@section('display_new','d-none')  @section('link_new', '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section ('content')
<div class="row">

  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
       <form name="form1" action="#" accept-charset="UTF-8"  method="post">
        {{ csrf_field() }}

        <div class="col-12 ">
          <div class="row">

             <div class="form-group col-md-1">
                <label class="uk-form-label"><b>Público</b></label>
                 <div class="animated-radio-button">
                  <label><input class="form-group" type="radio" name="publico" id="publico1" checked value="1" required><span class="label-text"> Si</span></label>
                
                  <label><input class="form-group" type="radio" name="publico" id="publico2" value="0" required><span class="label-text"> No</span></label>
               </div>
             </div>
             {{--  --}}
            <div class="col-lg-8">
                <label for="titulo" ><b>Título</b></label>
                <input class="form-control" placeholder="Título" name="titulo" id="titulo"  required>
                
             </div>
            
               <div class="form-group col-md-2">
                <label for="posicion" class="uk-form-label"><b>Posición</b></label>
                  <input type="text" name="posicion" id="posicion" class="form-control" placeholder="Posición">
             </div>
           
        <div class="form-group col-md-8">
            <div class="form-group col-md-6">
              <img id="imgSalida" src="{{asset('img/silueta2.png')}}" width="100%">
              
                <div class="form-group">
                  <label class="control-label">Seleccionar Imagen</label>
                  <input class="form-control" type="file">
                </div>
              
            </div>
             {{--  --}}
           
             {{--  --}}
             <div class="tile-footer col-md-12">
              <button class="btn btn-primary" name="guardar" type="submit">Guardar</button>
            </div>      
         </div>
      </div>
      </div>
  </form>
</div>
@endsection