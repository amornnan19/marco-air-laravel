@extends('layouts.admin')

@section('title', $article->title)

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">ดูบทความ</h1>
            <div class="space-x-2">
                <a href="{{ route('admin.articles.edit', $article) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    แก้ไข
                </a>
                <a href="{{ route('admin.articles.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg">
                    กลับ
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <!-- Article Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        @if ($article->is_published)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                เผยแพร่แล้ว
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                ร่าง
                            </span>
                        @endif
                        @if ($article->category)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $article->category }}
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

                    <div class="flex items-center text-sm text-gray-500 space-x-4">
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
                                {{ $article->published_at->format('d/m/Y H:i') }}
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
                    </div>
                </div>

                <!-- Article Image -->
                @if ($article->image)
                    <div class="px-6 pt-6">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                            class="w-full h-64 object-cover rounded-lg">
                    </div>
                @endif

                <!-- Article Excerpt -->
                @if ($article->excerpt)
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <p class="text-lg text-gray-700 font-medium leading-relaxed">{{ $article->excerpt }}</p>
                    </div>
                @endif

                <!-- Article Content -->
                <div class="p-6">
                    <div class="prose prose-lg max-w-none">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Article Info -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">ข้อมูลบทความ</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID:</span>
                        <span class="font-medium">#{{ $article->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">สถานะ:</span>
                        @if ($article->is_published)
                            <span class="text-green-600 font-medium">เผยแพร่แล้ว</span>
                        @else
                            <span class="text-gray-600 font-medium">ร่าง</span>
                        @endif
                    </div>
                    @if ($article->category)
                        <div class="flex justify-between">
                            <span class="text-gray-500">หมวดหมู่:</span>
                            <span class="font-medium">{{ $article->category }}</span>
                        </div>
                    @endif
                    @if ($article->author)
                        <div class="flex justify-between">
                            <span class="text-gray-500">ผู้เขียน:</span>
                            <span class="font-medium">{{ $article->author }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-500">ลำดับ:</span>
                        <span class="font-medium">{{ $article->sort_order }}</span>
                    </div>
                    @if ($article->reading_time)
                        <div class="flex justify-between">
                            <span class="text-gray-500">เวลาอ่าน:</span>
                            <span class="font-medium">{{ $article->reading_time }} นาที</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">สถิติ</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600">การอ่าน</span>
                        </div>
                        <span class="text-2xl font-bold text-gray-900">{{ number_format($article->views_count) }}</span>
                    </div>
                </div>
            </div>

            <!-- Dates -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">วันที่</h3>
                <div class="space-y-3 text-sm">
                    @if ($article->published_at)
                        <div>
                            <span class="text-gray-500">วันที่เผยแพร่:</span>
                            <div class="font-medium">{{ $article->published_at->format('d/m/Y H:i') }}</div>
                        </div>
                    @endif
                    <div>
                        <span class="text-gray-500">สร้างเมื่อ:</span>
                        <div class="font-medium">{{ $article->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div>
                        <span class="text-gray-500">แก้ไขล่าสุด:</span>
                        <div class="font-medium">{{ $article->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- SEO Info -->
            @if ($article->meta_description)
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">SEO</h3>
                    <div class="text-sm">
                        <span class="text-gray-500">Meta Description:</span>
                        <p class="mt-1 text-gray-700">{{ $article->meta_description }}</p>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">การจัดการ</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.articles.edit', $article) }}"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg text-center block">
                        แก้ไขบทความ
                    </a>
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                        onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบบทความนี้?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg">
                            ลบบทความ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection