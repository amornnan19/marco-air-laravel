@extends('layouts.dashboard')

@section('title', 'Dashboard - Marco Air')

@section('content')
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-sm mx-auto px-4 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-900">Marco Air</h1>
            <div class="flex items-center gap-3">
                @if (auth()->user()->line_avatar)
                    <img src="{{ auth()->user()->line_avatar }}" alt="Profile" class="w-8 h-8 rounded-full">
                @endif
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-sm mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Welcome to Dashboard!</h2>
            <p class="text-gray-600 mb-6">You have successfully logged in with LINE.</p>

            <div class="space-y-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-medium text-blue-900">Your Profile</h3>
                    <p class="text-sm text-blue-700 mt-1">Name: {{ auth()->user()->name }}</p>
                    <p class="text-sm text-blue-700">Email: {{ auth()->user()->email }}</p>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
