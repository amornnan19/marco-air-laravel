@extends('layouts.admin')

@section('title', 'ดูสินค้า: ' . $product->name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">ดูสินค้า: {{ $product->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    แก้ไข
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    กลับ
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Image -->
                    <div>
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                 class="w-full h-64 object-cover rounded-lg">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Basic Information -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">ข้อมูลพื้นฐาน</h2>
                        
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">ชื่อสินค้า</dt>
                                <dd class="text-sm text-gray-900">{{ $product->name }}</dd>
                            </div>

                            @if($product->model)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">รุ่น</dt>
                                    <dd class="text-sm text-gray-900">{{ $product->model }}</dd>
                                </div>
                            @endif

                            @if($product->brand)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">ยี่ห้อ</dt>
                                    <dd class="text-sm text-gray-900">{{ $product->brand }}</dd>
                                </div>
                            @endif

                            @if($product->btu)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">BTU</dt>
                                    <dd class="text-sm text-gray-900">{{ $product->btu }}</dd>
                                </div>
                            @endif

                            <div>
                                <dt class="text-sm font-medium text-gray-500">ราคา</dt>
                                <dd class="text-lg font-bold text-red-600">{{ $product->formatted_price }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">หมวดหมู่</dt>
                                <dd class="text-sm text-gray-900">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $product->category }}
                                    </span>
                                </dd>
                            </div>


                            <div>
                                <dt class="text-sm font-medium text-gray-500">สถานะ</dt>
                                <dd class="text-sm text-gray-900">
                                    <div class="flex flex-col space-y-1">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} w-fit">
                                            {{ $product->is_active ? 'เปิดใช้งาน' : 'ปิดใช้งาน' }}
                                        </span>
                                        @if($product->is_featured)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 w-fit">
                                                สินค้าแนะนำ
                                            </span>
                                        @endif
                                    </div>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">ลำดับการแสดง</dt>
                                <dd class="text-sm text-gray-900">{{ $product->sort_order }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Description -->
                @if($product->description)
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">รายละเอียดสินค้า</h3>
                        <div class="text-sm text-gray-700 bg-gray-50 p-4 rounded-lg">
                            {{ $product->description }}
                        </div>
                    </div>
                @endif

                <!-- Features -->
                @if($product->features && count($product->features) > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">คุณสมบัติเด่น</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($product->features as $feature)
                                    <li class="text-sm text-gray-700">{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Specifications -->
                @if($product->specifications && count($product->specifications) > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">ข้อมูลทางเทคนิค</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($product->specifications as $key => $value)
                                    <div class="flex justify-between border-b border-gray-200 pb-1">
                                        <span class="text-sm font-medium text-gray-600">{{ $key }}</span>
                                        <span class="text-sm text-gray-900">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Metadata -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">ข้อมูลเพิ่มเติม</h3>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">สร้างเมื่อ</dt>
                            <dd class="text-sm text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">อัปเดตล่าสุด</dt>
                            <dd class="text-sm text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection