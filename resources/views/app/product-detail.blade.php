@extends('layouts.app')

@section('title', '{{ $product->name }} - Marco Air')

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
                <h1 class="font-bold text-lg">{{ $product->name }}</h1>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-white">
            <!-- Product Image Section -->
            <div class="relative">
                @if ($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-80 object-cover">
                @else
                    <img src="https://placehold.co/400x300/E5E7EB/6B7280?text={{ urlencode($product->brand . '+' . $product->name) }}"
                        alt="{{ $product->name }}" class="w-full h-80 object-cover">
                @endif


                <!-- Brand Logo -->
                @if ($product->brand)
                    <div class="absolute top-4 left-4 bg-white px-2 py-1 rounded">
                        <span class="text-xs font-bold text-blue-600">{{ strtoupper($product->brand) }}</span>
                    </div>
                @endif

                <!-- Category Badge -->
                @if ($product->category)
                    <div
                        class="absolute bottom-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                        {{ $product->category }}
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="p-4">
                <h2 class="font-bold text-lg text-gray-900 mb-2">
                    {{ $product->name }}
                    @if ($product->model)
                        รุ่น {{ $product->model }}
                    @endif
                    @if ($product->btu)
                        {{ $product->btu }}
                    @endif
                </h2>


                <div class="text-2xl font-bold text-red-600 mb-2">{{ $product->formatted_price }}</div>
                <div class="text-sm text-gray-600 mb-6">ราคานี้ยังไม่รวมการติดตั้ง</div>

                <!-- Product Details -->
                <div class="border-t pt-4">
                    <h3 class="font-bold text-lg text-gray-900 mb-4">รายละเอียดสินค้า</h3>

                    @if ($product->description)
                        <div class="text-sm text-gray-700 leading-relaxed mb-6">
                            <p>{{ $product->description }}</p>
                        </div>
                    @endif

                    <!-- Features -->
                    @if ($product->features && count($product->features) > 0)
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-900 mb-3">คุณสมบัติเด่น</h4>
                            <ul class="list-disc pl-5 space-y-2 text-sm text-gray-700">
                                @foreach ($product->features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Specifications -->
                    @if ($product->specifications && count($product->specifications) > 0)
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-900 mb-3">ข้อมูลทางเทคนิค</h4>
                            <div class="space-y-2 text-sm">
                                @foreach ($product->specifications as $key => $value)
                                    <div class="flex justify-between border-b border-gray-100 pb-1">
                                        <span class="text-gray-600">{{ $key }}</span>
                                        <span class="text-gray-900 font-medium">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Related Products -->
                @if ($relatedProducts && $relatedProducts->count() > 0)
                    <div class="border-t pt-6 mt-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-4">สินค้าที่เกี่ยวข้อง</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($relatedProducts as $related)
                                <div class="bg-gray-50 rounded-lg p-3 cursor-pointer"
                                    onclick="window.location.href='{{ route('product.detail', $related->id) }}'">
                                    <h4 class="font-medium text-sm text-gray-900">{{ $related->name }}</h4>
                                    @if ($related->model)
                                        <p class="text-xs text-gray-600">{{ $related->model }}</p>
                                    @endif
                                    <p class="text-sm font-bold text-red-600 mt-1">{{ $related->formatted_price }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </main>

        <!-- Bottom Order Button -->
        <div class="bg-white border-t p-4">
            <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-4 rounded-lg">
                สั่งซื้อสินค้า
            </button>
        </div>
    </div>
@endsection
