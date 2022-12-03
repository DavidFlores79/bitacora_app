@extends('layouts.main', ['class' => 'bg-white'])

@section('page-title', 'Inicio')
@section('ngApp', 'home')
@section('ngController', 'home')

@section('content')

<div class="main mx-auto col-lg-10 d-flex flex-column align-items-center">
    @if (session()->has('errors'))
    <div id="permisos" class="card-text alert alert-danger position-absolute" id="error" role="alert" style="display: none;">
        {!! $errors->first('permisos') !!}
    </div>
    @endif



</div>




@endsection

@push('js')
<script src="{{ asset('assets') }}/js/home.js"></script>

@endpush
@push('os')

<script>
    // window.OneSignal = window.OneSignal || [];
    // OneSignal.push(function() {
    //     OneSignal.init({
    //         appId: "471d2d5f-4105-476e-a74d-68bf9277053e",
    //     });

    //     OneSignal.sendTag("perfil", "admin", function(tagsSent) {
    //         console.log('Perfil admin');
    //     });


    //     OneSignal.getUserId(function(userId) {
    //         console.log(userId);
    //     });
    // });
</script>

@endpush