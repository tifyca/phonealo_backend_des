@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Monitoreo de Remitos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
<div class="row">
	<div class="card-deck">
	<div class="card bg-light mb-3" style="max-width: 18rem;">
		<div class="card-header">Repartidor</div>
		<div class="card-body">
			<h5 class="card-title">Light card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>
	<div class="card bg-light mb-3" style="max-width: 20rem;">
		<div class="card-header">Repartidor</div>
		<div class="card-body">
			<h5 class="card-title">Light card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>
	<div class="card bg-light mb-3" style="max-width: 18rem;">
		<div class="card-header">Repartidor</div>
		<div class="card-body">
			<h5 class="card-title">Light card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>

	
</div>
</div>

<div class="row">
	<div class="card-deck">
	<div class="card bg-light mb-3" style="max-width: 18rem;">
		<div class="card-header">Repartidor</div>
		<div class="card-body">
			<h5 class="card-title">Light card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>
	<div class="card bg-light mb-3" style="max-width: 20rem;">
		<div class="card-header">Repartidor</div>
		<div class="card-body">
			<h5 class="card-title">Light card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>
	<div class="card bg-light mb-3" style="max-width: 18rem;">
		<div class="card-header">Repartidor</div>
		<div class="card-body">
			<h5 class="card-title">Light card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>

</div>
</div>

@endsection