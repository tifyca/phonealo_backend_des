@extends ('backend.layout.layout')

@section ('title', 'Administrador')

{{-- CABECERA : TITULO/ ICONOS DE ACCIONES --}}

@section ('title_seccion', 'Editar Slider')

@section ('back_seccion', 'back_slider')

@section ('action_seccion', 'Volver')

@section ('icon_seccion', 'arrow-left')

{{-- //////////////////////////////////// --}}

@section ('content')

	<div class="uk-margin-medium-top uk-card uk-card-default uk-card-body uk-width-1-1">
		
		<form class=" uk-margin-bottom" uk-grid>
			<div class="uk-width-1-4 uk-child-width-auto">
		    	<p>Público</p>
	            <label><input class="uk-radio" type="radio" name="radio2" checked> Si</label>
	            <label><input class="uk-radio" type="radio" name="radio2"> No</label>
	        </div>
            <div class="uk-width-3-4"  uk-grid>
                <div class="uk-width-1-1">
                    <b>Adjuntar </b><small>(opcional)</small>
                </div>
                <div class="js-upload  uk-margin-small-top" uk-form-custom>
                    <input type="file" multiple>
                    <button class="uk-button uk-button-default an-button-select" type="button" tabindex="-1">Archivo</button>
                </div>
                <div class="uk-flex uk-flex-center uk-margin-small-top">
                    O
                </div>
                 <div class="uk-width-expand uk-margin-small-top">
                    <input class="uk-input" placeholder="Enlace">
                </div>
            </div>
	        
            
		    <div class="uk-width-1-1">
				<input class="uk-input  uk-paddin-left" placeholder="Título">
		    </div>
		   

		    <div class="uk-width-1-1">
				<textarea name="" class="uk-textarea" rows="5" placeholder="Texto" ></textarea>
		    </div>
            <div class="uk-width-1-4">
                <select class="uk-select uk-paddin-left ">
                    <option>Posición</option>
                </select>
            </div>
		    
		    <div class=" uk-width-1-1 uk-margin-medium-left js-upload uk-placeholder uk-text-center">
			    <span uk-icon="icon: cloud-upload"></span>
			    <span class="uk-text-middle">Arrasta y suelta la imagen o </span>
			    <div uk-form-custom>
			        <input type="file" multiple>
			        <span class="uk-link">seleccionala aquí </span>
			    </div>
			</div>

			<progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
					    <div class="uk-width-auto">
					    	<input class="uk-button uk-button-primary uk-form-width-small" type="" name="" value="Guardar">
					    </div>
		</form>
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

