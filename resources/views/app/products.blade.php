@extends('layouts.app')

@section('title', 'ผลิตภัณฑ์ - Marco Air')

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
                        <h1 class="font-medium text-sm">สินค้าต้องรับ</h1>
                        <h2 class="font-bold text-lg">ศักดา ทุนดิษ</h2>
                    </div>
                </div>
                <div class="relative">
                    <button class="p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 00-15 0v5h5l-5 5-5-5h5V7a9.5 9.5 0 0119 0v10z"></path>
                        </svg>
                    </button>
                    <!-- Notification Badge -->
                    <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 pb-20 overflow-y-auto">
            <!-- Promotion Banner -->
            <div class="py-4">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="https://placehold.co/400x200/4F46E5/FFFFFF?text=Promotion+Banner" alt="Promotion" 
                        class="w-full h-48 object-cover">
                    <div class="absolute bottom-4 left-4 right-4">
                        <!-- Carousel Indicators -->
                        <div class="flex justify-center space-x-2 mb-4">
                            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                            <div class="w-2 h-2 bg-white/50 rounded-full"></div>
                            <div class="w-2 h-2 bg-white/50 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Icons -->
            <div class="py-4">
                <div class="flex justify-around bg-white rounded-lg shadow-sm p-4">
                    <!-- Service 1 -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs text-gray-700 font-medium">ทั้งหมด</span>
                    </div>

                    <!-- Service 2 -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs text-gray-700 font-medium">หมวดหมู่</span>
                    </div>

                    <!-- Service 3 -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-xs text-gray-700 font-medium">สินค้าขาย</span>
                    </div>

                    <!-- Service 4 -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs text-gray-700 font-medium">โปรโมชั่น</span>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="py-4">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Product 1 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>

                    <!-- Product 5 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>

                    <!-- Product 6 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>

                    <!-- Product 7 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>

                    <!-- Product 8 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="https://placehold.co/200x150/E5E7EB/6B7280?text=Tanin+AC" alt="Tanin AC" 
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Tanin</h3>
                            <p class="text-xs text-gray-600 mb-1">T T 4455</p>
                            <p class="text-xs text-gray-600 mb-2">12,000 Btu</p>
                            <p class="text-red-600 font-bold text-sm">฿ 11,990</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.sticky-bottom-navigation')
    </div>
@endsection