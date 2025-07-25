@extends('layouts.app')

@section('title', 'ข้อเสนอพิเศษ - Marco Air')

@section('content')
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
            <div class="max-w-md mx-auto flex items-center gap-3">
                <button onclick="history.back()" class="p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h1 class="font-bold text-lg">ข้อเสนอพิเศษ</h1>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 pb-20 overflow-y-auto">
            <div class="py-4">
                @forelse($promotions as $promotion)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-4 cursor-pointer"
                        onclick="window.location.href='{{ route('promotion.show', $promotion) }}'">
                        <!-- Promotion Image -->
                        @if ($promotion->image)
                            <div class="relative">
                                <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}"
                                    class="w-full h-48 object-cover">
                                <!-- Status badge -->
                                @if ($promotion->is_active)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-green-600 text-white text-xs font-medium px-2 py-1 rounded-full">
                                            ใช้งานได้
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Fallback with gradient background -->
                            <div
                                class="relative h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-16 h-16 mx-auto mb-2 opacity-80" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2h4a1 1 0 110 2h-1v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM6 6v10h8V6H6zm3 3a1 1 0 112 0v4a1 1 0 11-2 0V9z">
                                        </path>
                                    </svg>
                                    <p class="text-sm font-medium">{{ $promotion->title }}</p>
                                </div>
                                @if ($promotion->is_active)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-white/20 text-white text-xs font-medium px-2 py-1 rounded-full">
                                            ใช้งานได้
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Promotion Content -->
                        <div class="p-4">
                            <h2 class="font-bold text-lg text-gray-900 mb-2 leading-tight">{{ $promotion->title }}</h2>

                            <p class="text-gray-600 text-sm mb-3 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($promotion->content), 120) }}
                            </p>

                            <!-- Promotion Meta -->
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center space-x-3">
                                    @if ($promotion->start_date)
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            เริ่ม {{ $promotion->start_date->format('d/m/Y') }}
                                        </div>
                                    @endif
                                    @if ($promotion->end_date)
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            ถึง {{ $promotion->end_date->format('d/m/Y') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center">
                                    @if ($promotion->button_text)
                                        <span class="text-blue-600 font-medium">{{ $promotion->button_text }}</span>
                                    @else
                                        <span class="text-blue-600 font-medium">ดูรายละเอียด</span>
                                    @endif
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2h4a1 1 0 110 2h-1v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM6 6v10h8V6H6zm3 3a1 1 0 112 0v4a1 1 0 11-2 0V9z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">ยังไม่มีโปรโมชั่น</h3>
                        <p class="text-gray-500 text-sm">โปรโมชั่นจะแสดงที่นี่เมื่อมีข้อเสนอพิเศษ</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if ($promotions->hasPages())
                    <div class="mt-6">
                        {{ $promotions->links() }}
                    </div>
                @endif
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.sticky-bottom-navigation')
    </div>
@endsection
