@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Inicio')
@section('ngApp', 'home')
@section('ngController', 'home')

@section('content')

    <div class="main mx-auto col-lg-10 d-flex flex-column align-items-center">
        @if (session()->has('errors'))
            <div id="permisos" class="card-text alert alert-danger position-absolute" id="error" role="alert"
                style="display: none;">
                {!! $errors->first('permisos') !!}
            </div>
        @endif



    </div>




@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/home.js"></script>
@endpush
