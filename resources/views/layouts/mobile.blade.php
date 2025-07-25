@extends('layouts.app')

@section('body')
    <div class="min-h-screen @yield('container-class', 'flex items-center justify-center') px-4">
        <div class="w-full max-w-sm mx-auto">
            @yield('content')
        </div>
    </div>
@endsection