@extends('layouts.app')

@section('title', 'Dealer Dashboard - Marco Air')

@section('content')
    <div class="flex flex-col h-full">
        <!-- User Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
            <div class="max-w-md mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if (auth()->user()->line_avatar)
                        <img src="{{ auth()->user()->line_avatar }}" alt="Profile"
                            class="w-12 h-12 rounded-full border-2 border-white/20">
                    @else
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h1 class="font-bold text-lg">สวัสดีคุณ {{ auth()->user()->first_name ?? auth()->user()->name }}
                        </h1>
                        <h2 class="text-white/80 text-sm">{{ auth()->user()->name }} (ตัวแทน)</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 pb-20 overflow-y-auto">
            <div class="py-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900">Dealer Dashboard</h2>
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.sticky-bottom-navigation')
    </div>
@endsection