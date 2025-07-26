@extends('layouts.app')

@section('title', '{{ $service->name }} - Marco Air')

@section('content')
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
            <div class="flex items-center gap-3">
                <button onclick="history.back()" class="p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h1 class="font-bold text-lg">{{ $service->name }}</h1>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-white">
            <!-- Hero Section -->
            <div class="relative">
                <!-- Service Hero Image with Overlay -->
                <div class="relative h-64">
                    @if($service->hero_image_url)
                        <img src="{{ $service->hero_image_url }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-{{ $service->icon_color }}-500 to-{{ $service->icon_color }}-600"></div>
                    @endif
                    <div class="absolute inset-0 bg-black/20"></div>
                    
                    <!-- Service Title and Description -->
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h2 class="text-white text-2xl font-bold mb-2">{{ $service->name }}</h2>
                        <p class="text-white/90 text-sm">{{ $service->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Service Packages -->
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-4">ล้างแอร์ติดผนัง</h3>
                
                <div class="space-y-3">
                    @foreach($service->packages as $package)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm flex-1">{{ $package['name'] }}</h4>
                                <div class="text-right ml-3">
                                    <span class="text-lg font-bold text-{{ $service->icon_color }}-600">{{ number_format($package['price']) }} บาท</span>
                                    <span class="text-xs text-gray-500 block">/ {{ $package['unit'] }}</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">{{ $package['description'] }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Service Details -->
                <div class="mt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">รายละเอียดและเงื่อนไข</h3>
                    
                    <div class="space-y-3">
                        @foreach($service->details as $detail)
                            <div class="flex items-start gap-3">
                                <div class="w-1.5 h-1.5 bg-{{ $service->icon_color }}-600 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-sm text-gray-700 leading-relaxed">{{ $detail }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mt-8 bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">ค่าบริการ/สินค้า</h4>
                            <p class="text-xs text-gray-600">ราคา : <span class="text-red-600 font-bold">{{ $service->formatted_price_display }} / เครื่อง</span></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-4 h-4 bg-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="4"/>
                            </svg>
                        </div>
                        <p class="text-xs text-blue-700">สอบถามรายละเอียดเพิ่มเติมได้ที่โทร. {{ $service->contact_phone ?? '02-888-8888' }}</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Bottom Action Button -->
        <div class="bg-white border-t p-4">
            <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-4 rounded-lg">
                สนใจบริการ
            </button>
        </div>
    </div>
@endsection