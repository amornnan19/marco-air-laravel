@extends('layouts.app')

@section('title', 'บทความ - Marco Air')

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
                <h1 class="font-bold text-lg">บทความ</h1>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 pb-20 overflow-y-auto">
            <div class="py-4">
                @forelse($articles as $article)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-4 cursor-pointer"
                        onclick="window.location.href='{{ route('article.show', $article) }}'">
                        <!-- Article Image -->
                        @if ($article->image)
                            <div class="relative">
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                    class="w-full h-48 object-cover">
                                @if ($article->category)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-blue-600 text-white text-xs font-medium px-2 py-1 rounded-full">
                                            {{ $article->category }}
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
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                    <p class="text-sm font-medium">{{ $article->title }}</p>
                                </div>
                                @if ($article->category)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-white/20 text-white text-xs font-medium px-2 py-1 rounded-full">
                                            {{ $article->category }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="p-4">
                            <h2 class="font-bold text-lg text-gray-900 mb-2 leading-tight">{{ $article->title }}</h2>

                            <p class="text-gray-600 text-sm mb-3 line-clamp-2 leading-relaxed">
                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <!-- Article Meta -->
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center space-x-3">
                                    @if ($article->author)
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            {{ $article->author }}
                                        </div>
                                    @endif
                                    @if ($article->published_at)
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ $article->published_at->format('d/m/Y') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-3">
                                    @if ($article->reading_time)
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $article->reading_time }} นาที
                                        </div>
                                    @endif
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        {{ number_format($article->views_count) }}
                                    </div>
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
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">ยังไม่มีบทความ</h3>
                        <p class="text-gray-500 text-sm">บทความจะแสดงที่นี่เมื่อมีการเผยแพร่</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if ($articles->hasPages())
                    <div class="mt-6">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.sticky-bottom-navigation')
    </div>
@endsection
