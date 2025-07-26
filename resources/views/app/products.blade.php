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
                    <div
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 pb-20 overflow-y-auto">
            <!-- Promotion Banner -->
            @if($promotions && $promotions->count() > 0)
                <div class="py-4">
                    <div class="relative bg-white rounded-lg shadow-sm overflow-hidden">
                        <!-- Promotion Carousel -->
                        <div class="relative h-48 overflow-hidden">
                            @foreach($promotions as $index => $promotion)
                                <div class="promotion-slide absolute inset-0 transition-transform duration-300 ease-in-out {{ $index === 0 ? 'translate-x-0' : 'translate-x-full' }}" 
                                     data-slide="{{ $index }}">
                                    @if($promotion->image)
                                        <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}"
                                            class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                            <div class="text-center text-white p-6">
                                                <h3 class="text-lg font-bold mb-2">{{ $promotion->title }}</h3>
                                                <p class="text-sm opacity-90">{{ Str::limit(strip_tags($promotion->content), 100) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($promotion->link_url && $promotion->button_text)
                                        <div class="absolute inset-0 bg-black/20 flex items-end">
                                            <div class="p-4 w-full">
                                                <button onclick="window.open('{{ $promotion->link_url }}', '_blank')"
                                                    class="bg-white text-blue-600 px-4 py-2 rounded font-medium text-sm hover:bg-blue-50 transition-colors">
                                                    {{ $promotion->button_text }}
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Carousel Indicators -->
                        @if($promotions->count() > 1)
                            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2">
                                <div class="flex space-x-2">
                                    @foreach($promotions as $index => $promotion)
                                        <button class="indicator w-2 h-2 rounded-full transition-colors {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"
                                                onclick="showSlide({{ $index }})"
                                                data-indicator="{{ $index }}"></button>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Navigation Arrows -->
                            <button class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/30 text-white p-2 rounded-full hover:bg-black/50 transition-colors"
                                    onclick="prevSlide()">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/30 text-white p-2 rounded-full hover:bg-black/50 transition-colors"
                                    onclick="nextSlide()">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endif

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
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden cursor-pointer"
                            onclick="window.location.href='{{ route('product.detail', $product->id) }}'">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                    class="w-full h-32 object-cover">
                            @else
                                <img src="https://placehold.co/200x150/E5E7EB/6B7280?text={{ urlencode($product->brand . '+' . $product->name) }}" 
                                    alt="{{ $product->name }}" class="w-full h-32 object-cover">
                            @endif
                            <div class="p-3">
                                <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $product->name }}</h3>
                                @if($product->model)
                                    <p class="text-xs text-gray-600 mb-1">{{ $product->model }}</p>
                                @endif
                                @if($product->btu)
                                    <p class="text-xs text-gray-600 mb-2">{{ $product->btu }}</p>
                                @endif
                                <p class="text-red-600 font-bold text-sm">{{ $product->formatted_price }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.sticky-bottom-navigation')
    </div>

    @if($promotions && $promotions->count() > 1)
        <script>
            let currentSlide = 0;
            const totalSlides = {{ $promotions->count() }};
            
            function showSlide(index) {
                currentSlide = index;
                
                // Hide all slides
                document.querySelectorAll('.promotion-slide').forEach((slide, i) => {
                    slide.style.transform = i === index ? 'translateX(0)' : 'translateX(100%)';
                });
                
                // Update indicators
                document.querySelectorAll('.indicator').forEach((indicator, i) => {
                    indicator.classList.toggle('bg-white', i === index);
                    indicator.classList.toggle('bg-white/50', i !== index);
                });
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }
            
            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            }
            
            // Auto-play carousel every 5 seconds
            setInterval(() => {
                nextSlide();
            }, 5000);
        </script>
    @endif
@endsection
