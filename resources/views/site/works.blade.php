@extends('layouts.site')
@section('title', ' - Trabajos')
@section('style', 'bg_portada1 px-0')
@section('works', 'active')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <img src="img/trabajos.svg" class="img_blend img-fluid" alt="Texto Trabajos">
        </div>
    </div>
</div>
@endsection

@section('main')
    @livewire('site.events')

@endsection