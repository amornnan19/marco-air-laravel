@extends('layouts.app')

@section('title', $article->title . ' - Marco Air')

@section('content')
    <div class="flex flex-col h-full">
        <!-- Header with Back Button -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
            <div class="max-w-md mx-auto flex items-center gap-3">
                <button onclick="history.back()" class="p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <div class="flex-1 min-w-0">
                    <h1 class="font-bold text-lg truncate">{{ $article->title }}</h1>
                    @if ($article->category)
                        <p class="text-white/80 text-sm">{{ $article->category }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 py-6 overflow-y-auto">
            <!-- Article Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <!-- Article Image -->
                @if ($article->image)
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                        class="w-full h-48 object-cover rounded-lg mb-4">
                @endif

                <!-- Article Title -->
                <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

                <!-- Article Meta -->
                <div class="flex items-center text-sm text-gray-500 space-x-4 mb-4">
                    @if ($article->author)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $article->author }}
                        </div>
                    @endif
                    @if ($article->published_at)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $article->published_at->format('d/m/Y') }}
                        </div>
                    @endif
                    @if ($article->reading_time)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $article->reading_time }} นาที
                        </div>
                    @endif
                </div>

                <!-- Article Excerpt -->
                @if ($article->excerpt)
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                        <p class="text-blue-800 font-medium">{{ $article->excerpt }}</p>
                    </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                    {!! $article->content !!}
                </div>
            </div>

            <!-- Article Stats -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        {{ number_format($article->views_count) }} ครั้ง
                    </div>
                    <button onclick="shareArticle()"
                        class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                            </path>
                        </svg>
                        แชร์
                    </button>
                </div>
            </div>

            <!-- Related Articles -->
            @php
                $relatedArticles = App\Models\Article::published()
                    ->where('id', '!=', $article->id)
                    ->when($article->category, function ($query) use ($article) {
                        return $query->byCategory($article->category);
                    })
                    ->ordered()
                    ->limit(3)
                    ->get();
            @endphp

            @if ($relatedArticles->count() > 0)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">บทความที่เกี่ยวข้อง</h3>
                    <div class="space-y-4">
                        @foreach ($relatedArticles as $relatedArticle)
                            <div class="flex gap-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition-colors"
                                onclick="window.location.href='{{ route('article.show', $relatedArticle) }}'">
                                @if ($relatedArticle->image)
                                    <div class="w-16 h-16 flex-shrink-0">
                                        <img src="{{ $relatedArticle->image_url }}" alt="{{ $relatedArticle->title }}"
                                            class="w-full h-full object-cover rounded-lg">
                                    </div>
                                @else
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex-shrink-0 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 text-sm leading-tight">
                                        {{ Str::limit($relatedArticle->title, 60) }}
                                    </h4>
                                    <p class="text-gray-600 text-xs mt-1 line-clamp-2">
                                        {{ $relatedArticle->excerpt ?: Str::limit(strip_tags($relatedArticle->content), 80) }}
                                    </p>
                                    <div class="flex items-center mt-1 text-xs text-gray-500 space-x-2">
                                        @if ($relatedArticle->reading_time)
                                            <span>{{ $relatedArticle->reading_time }} นาที</span>
                                        @endif
                                        <span>{{ number_format($relatedArticle->views_count) }} ครั้ง</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </main>
    </div>

    <script>
        function shareArticle() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $article->title }}',
                    text: '{{ $article->excerpt ?: Str::limit(strip_tags($article->content), 100) }}',
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    alert('ลิงก์บทความได้ถูกคัดลอกแล้ว!');
                });
            }
        }
    </script>
@endsection