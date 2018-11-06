@extends ('Delivery.documentacion.layout.layout')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-home')
@section('titulo', 'App Delivery')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '')
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
Este documento se desarrolló, con la finalidad de ofrecer documentación técnica basadas en todos los Endpoints, creados para la APP, necesarios para la comunicación del APP con el ERP

@endsection

@push('scripts')


@endpush
