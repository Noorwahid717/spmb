@extends('theme::layouts.app')


@section('content')

@if( !auth()->guest() && auth()->user()->role_id==1 )
@include('theme::dashboard.dashboard-super')
@endif

@if( !auth()->guest() && auth()->user()->role_id==3 )
@include('theme::dashboard.dashboard-camaba')
@endif

@if( !auth()->guest() && auth()->user()->role_id==7 )
@include('theme::dashboard.dashboard-bendahara')
@endif

@if( !auth()->guest() && auth()->user()->role_id==8 )
@include('theme::dashboard.dashboard-pendaftaran')
@endif

@endsection