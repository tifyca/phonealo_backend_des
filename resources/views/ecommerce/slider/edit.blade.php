@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar Slider')
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
<<<<<<< HEAD
        <form name="form2" action="#" accept-charset="UTF-8"  method="post">
         {{ csrf_field() }}
            <div class="col-12">
              <div class="row">
                <div class="form-group col-md-1">
                    <label class="uk-form-label"><b>Público</b></label>
                      <div class="animated-radio-button">
                        <label><input class="form-group" type="radio" name="publico" id="publico1" checked value="1" required><span class="label-text"> Si</span></label>
                        <label><input class="form-group" type="radio" name="publico" id="publico2" value="0" required><span class="label-text"> No</span></label>
                      </div>
                </div>
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
                  <div class="tile-footer col-md-12">
                    <button class="btn btn-primary" name="guardar" type="submit">Guardar</button>
                  </div>      
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
=======
                <form name="form2" action="#" accept-charset="UTF-8"  method="post">
                    {{ csrf_field() }}
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-md-1">
                               <label class="uk-form-label"><b>Público</b></label>
                                 <div class="animated-radio-button">
                                  <label><input class="form-group" type="radio" name="publico" id="publico1" checked value="1" required><span class="label-text"> Si</span></label>
                                  <label><input class="form-group" type="radio" name="publico" id="publico2" value="0" required><span class="label-text"> No</span></label>
                               </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                  <label class="control-label"><b>Adjuntar</b><small>(opcional)</small></label>
                                  <input class="form-control" type="file">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="enlace" class="uk-form-label">O <b>Enlace</b></label>
                              <input type="text" name="enlace" id="enlace" class="form-control" placeholder="Enlace">
                         </div>
                         <div class="col-lg-8">
                        <label for="titulo" ><b>Título</b></label>
                        <input class="form-control" placeholder="Título" name="titulo" id="titulo"  required>
                        <textarea name="texto" id="texto" placeholder="Texto" class="form-control" cols="5"></textarea>
                        <select class="form-control" id="posicion" name="posicion">
                          <option value="0">Posición</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                                <div class="form-group">
                                  <label class="control-label"><b>Arrastra y suelta la imagen </b><small>O seleccionala aqui</small></label>
                                  <input class="form-control" type="file">
                                </div>
                            </div>
                        <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                        <div class="tile-footer col-md-12">
                          <button class="btn btn-primary" name="guardar" type="submit">Guardar</button>
                        </div>     
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
    <script>

    var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {

        url: '',
        multiple: true,

        beforeSend: function () {
            console.log('beforeSend', arguments);
        },
        beforeAll: function () {
            console.log('beforeAll', arguments);
        },
        load: function () {
            console.log('load', arguments);
        },
        error: function () {
            console.log('error', arguments);
        },
        complete: function () {
            console.log('complete', arguments);
        },

        loadStart: function (e) {
            console.log('loadStart', arguments);

            bar.removeAttribute('hidden');
            bar.max = e.total;
            bar.value = e.loaded;
        },

        progress: function (e) {
            console.log('progress', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        loadEnd: function (e) {
            console.log('loadEnd', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        completeAll: function () {
            console.log('completeAll', arguments);

            setTimeout(function () {
                bar.setAttribute('hidden', 'hidden');
            }, 1000);

            alert('Upload Completed');
        }

    });

</script>
@endpush

>>>>>>> ffd95304466eb5ddfb09dec108d9c9cfc4687554
