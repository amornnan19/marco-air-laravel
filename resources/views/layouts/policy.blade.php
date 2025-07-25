@extends('layouts.app')

@section('body')
    <div class="min-h-screen py-8 px-4">
        <div class="w-full max-w-sm mx-auto">
            @yield('content')
        </div>
    </div>
@endsection