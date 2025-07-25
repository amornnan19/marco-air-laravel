@extends('layouts.app')

@section('title', 'Dashboard - Marco Air')

@section('content')
    <!-- User Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
        <div class="max-w-sm mx-auto flex items-center justify-between">
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
                    <h1 class="font-bold text-lg">สวัสดีคุณ {{ auth()->user()->first_name ?? auth()->user()->name }}</h1>
                    <h2 class="text-white/80 text-sm">{{ auth()->user()->name }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-sm mx-auto px-4 pb-20">
        <!-- Special Offers Section -->
        <div class="py-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-gray-900">ข้อเสนอพิเศษ</h3>
                <a href="#" class="text-blue-600 text-sm font-medium">ดูทั้งหมด</a>
            </div>

            <!-- Promotion Carousel -->
            <div class="overflow-x-auto scrollbar-hide">
                <div class="flex gap-4 w-max">
                    @forelse($promotions as $promotion)
                        <div class="rounded-lg w-72 h-48 relative overflow-hidden cursor-pointer shadow-lg"
                            onclick="window.location.href='{{ route('promotion.show', $promotion) }}'">
                            @if ($promotion->image)
                                <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <!-- Fallback gradient if no image -->
                                <div
                                    class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <h4 class="font-bold text-lg mb-2">{{ $promotion->title }}</h4>
                                        <p class="text-white/80 text-sm">
                                            {{ Str::limit(strip_tags($promotion->content), 60) }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($promotion->image)
                                <!-- Overlay for better text readability -->
                                <div class="absolute inset-0 bg-black/20"></div>
                                <!-- Title overlay -->
                                <div
                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                    <h4 class="font-bold text-white text-lg">{{ $promotion->title }}</h4>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div
                            class="bg-gradient-to-r from-gray-400 to-gray-500 rounded-lg p-4 w-72 text-white relative overflow-hidden">
                            <div class="relative z-10">
                                <h4 class="font-bold text-lg mb-2">ไม่มีโปรโมชั่น</h4>
                                <p class="text-white/80 text-sm mb-3">ขณะนี้ยังไม่มีโปรโมชั่นพิเศษ</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="py-4">
            <h3 class="text-lg font-bold text-gray-900 mb-4">บริการ</h3>

            <div class="grid grid-cols-4 gap-4">
                <!-- Service 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">ล้างแอร์</span>
                </div>

                <!-- Service 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">ซ่อมแอร์</span>
                </div>

                <!-- Service 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">ติดตั้งแอร์ใหม่</span>
                </div>

                <!-- Service 4 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">ตรวจสอบแอร์</span>
                </div>

                <!-- Service 5 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">บริการฉุกเฉิน</span>
                </div>

                <!-- Service 6 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">ช่วยเหลือเฉินร้อฟร์</span>
                </div>

                <!-- Service 7 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-pink-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">บะบดสถิตอพร์</span>
                </div>

                <!-- Service 8 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-2 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 font-medium">อื่นๆ</span>
                </div>
            </div>
        </div>

        <!-- Articles Section -->
        <div class="py-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">บทความ</h3>
                <a href="#" class="text-blue-600 text-sm font-medium">ดูทั้งหมด</a>
            </div>

            <div class="space-y-4">
                <!-- Article 1 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-4">
                        <div class="flex gap-3">
                            <div class="w-20 h-20 bg-blue-500 rounded-lg flex-shrink-0 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">7</span>
                                <span class="text-white text-xs ml-1">สิ่งของ<br>ที่ได้เกียดไ้</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">7 สิ่งของที่ได้เลยจากการล้างแอร์</h4>
                                <p class="text-gray-600 text-sm line-clamp-2">
                                    ทำความสะอาดแอร์เป็นประจำจะช่วยให้แอร์ใช้งานได้นานขึ้น และประหยัดค่าไฟ</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-4">
                        <div class="flex gap-3">
                            <div class="w-20 h-20 bg-orange-500 rounded-lg flex-shrink-0 flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">แอร์ไส่เซร์วิส</h4>
                                <p class="text-gray-600 text-sm line-clamp-2">บทพืนมิร่งมิร่างไว้</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Sticky Bottom Navigation -->
    @include('components.sticky-bottom-navigation')
@endsection
