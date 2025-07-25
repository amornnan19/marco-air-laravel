@extends('layouts.app')

@section('title', $promotion->title . ' - Marco Air')

@section('content')

    <!-- Header with Back Button -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
        <div class="max-w-sm mx-auto flex items-center gap-3">
            <button onclick="history.back()" class="p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <h1 class="font-bold text-lg">{{ $promotion->title }}</h1>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-sm mx-auto px-4 py-6">
        <!-- Promotion Banner -->
        <div
            class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white mb-6 relative overflow-hidden">
            @if ($promotion->image)
                <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}"
                    class="w-full h-48 object-cover rounded-lg mb-4">
            @endif

            <div class="relative z-10">
                <h2 class="text-2xl font-bold mb-3">{{ $promotion->title }}</h2>

                @if ($promotion->start_date || $promotion->end_date)
                    <div class="text-white/80 text-sm mb-4">
                        @if ($promotion->start_date && $promotion->end_date)
                            ระยะเวลาโปรโมชั่น: {{ $promotion->start_date->format('d/m/Y') }} -
                            {{ $promotion->end_date->format('d/m/Y') }}
                        @elseif($promotion->start_date)
                            เริ่มตั้งแต่: {{ $promotion->start_date->format('d/m/Y') }}
                        @elseif($promotion->end_date)
                            สิ้นสุด: {{ $promotion->end_date->format('d/m/Y') }}
                        @endif
                    </div>
                @endif
            </div>

            <!-- Decorative Elements -->
            <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute right-0 bottom-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mb-12"></div>
        </div>

        <!-- Content Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">รายละเอียดโปรโมชั่น</h3>
            <div class="text-gray-700 leading-relaxed space-y-3 prose prose-sm max-w-none">
                {!! $promotion->content !!}
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            @if ($promotion->link_url && $promotion->link_url !== '#')
                <a href="{{ $promotion->link_url }}" target="_blank"
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium py-3 px-4 rounded-lg text-center block hover:opacity-90 transition-opacity">
                    {{ $promotion->button_text }}
                </a>
            @endif
        </div>
    </main>

    <script>
        function sharePromotion() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $promotion->title }}',
                    text: '{{ Str::limit(strip_tags($promotion->content), 100) }}',
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    alert('ลิงก์โปรโมชั่นได้ถูกคัดลอกแล้ว!');
                });
            }
        }
    </script>
@endsection
