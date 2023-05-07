@extends('theme::layouts.app')


@section('content')


<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div
        class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
        {{-- <div
            class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            --}}
            {{-- <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">

            </div>
            <div class="relative flex-1">

            </div> --}}

            {{--
        </div> --}}
        <div class="relative p-5">
            {{-- @if( !auth()->guest() && auth()->user()->role_id==3 ) --}}
            {{-- @include('themes/tailwind/dashboard/dashboar-camaba') --}}
            {{-- @include('theme::dashboard.dashboard-camaba') --}}
            {{-- @endif --}}
        </div>
    </div>
</div>

@endsection