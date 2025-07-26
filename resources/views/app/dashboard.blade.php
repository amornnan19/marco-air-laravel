@extends('layouts.app')

@section('title', 'Dashboard - Marco Air')

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
                        <h1 class="text-white/80 text-sm">ยินดีต้อนรับ</h1>
                        <h2 class="font-bold text-lg">คุณ {{ auth()->user()->first_name ?? auth()->user()->name }}</h2>
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
                    <div
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 pb-20 overflow-y-auto overflow-x-hidden">
            <!-- Content Container -->
            <div class="max-w-md mx-auto">
                <!-- Special Offers Section -->
                <div class="py-4 px-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-bold text-gray-900">ข้อเสนอพิเศษ</h3>
                        <a href="{{ route('promotions.index') }}" class="text-blue-600 text-sm font-medium">ดูทั้งหมด</a>
                    </div>
                </div>

                <!-- Promotion Carousel -->
                <x-promotion-carousel :promotions="$promotions" />

                <!-- Services Section -->
                <div class="py-4 px-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">บริการ</h3>

                    <div class="grid grid-cols-3 gap-4">
                        <!-- Service 1 -->
                        <div class="bg-blue-100 rounded-lg p-4 text-center cursor-pointer hover:bg-blue-200 transition-colors"
                            onclick="window.location.href='{{ route('service.show', 'air-cleaning') }}'">
                            <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11h4v-6h6v6h4V7l-7-5z" />
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm text-gray-800 font-medium">ล้างแอร์</span>
                        </div>

                        <!-- Service 2 -->
                        <div class="bg-green-100 rounded-lg p-4 text-center cursor-pointer hover:bg-green-200 transition-colors"
                            onclick="window.location.href='{{ route('service.show', 'air-repair') }}'">
                            <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm text-gray-800 font-medium">ซ่อมแอร์</span>
                        </div>

                        <!-- Service 3 -->
                        <div class="bg-orange-100 rounded-lg p-4 text-center cursor-pointer hover:bg-orange-200 transition-colors"
                            onclick="window.location.href='{{ route('service.show', 'air-installation') }}'">
                            <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm text-gray-800 font-medium">ติดตั้งแอร์ย้ายแอร์</span>
                        </div>

                        <!-- Service 4 -->
                        <div class="bg-purple-100 rounded-lg p-4 text-center">
                            <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm text-gray-800 font-medium">ปรึกษาผู้เชี่ยวชาญ ฟรี!</span>
                        </div>

                        <!-- Service 5 -->
                        <div class="bg-yellow-100 rounded-lg p-4 text-center">
                            <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm text-gray-800 font-medium">ชมผลิตภัณฑ์</span>
                        </div>
                    </div>
                </div>

                <!-- Articles Section -->
                <div class="py-4 px-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">บทความ</h3>
                        <a href="{{ route('articles.index') }}" class="text-blue-600 text-sm font-medium">ดูทั้งหมด</a>
                    </div>
                </div>

                <!-- Article Cards Horizontal Scroll -->
                <div class="py-2 px-4">
                    <div class="overflow-x-auto scrollbar-hide">
                        <div class="flex gap-4 w-max">
                            @forelse($articles as $article)
                                <div class="w-64 bg-white rounded-lg shadow-sm overflow-hidden cursor-pointer flex-shrink-0"
                                    onclick="window.location.href='{{ route('article.show', $article) }}'">
                                    @if ($article->image)
                                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                            class="w-full h-32 object-cover">
                                    @else
                                        <div
                                            class="w-full h-32 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <h4 class="font-semibold text-gray-900 mb-2 text-sm line-clamp-2">
                                            {{ $article->title }}</h4>
                                        <p class="text-gray-600 text-xs line-clamp-2 mb-2">
                                            {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 80) }}
                                        </p>
                                        <div class="flex items-center text-xs text-gray-500">
                                            @if ($article->reading_time)
                                                <span>อ่าน {{ $article->reading_time }} นาที</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="w-64 bg-white rounded-lg shadow-sm p-6 text-center text-gray-500 flex-shrink-0">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                    <p class="text-sm">ยังไม่มีบทความ</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.sticky-bottom-navigation')
    </div>

@endsection
