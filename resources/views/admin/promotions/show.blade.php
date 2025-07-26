@extends('layouts.admin')

@section('title', $promotion->title . ' - Admin Panel')

@section('content')
    <div class="px-4 py-6 sm:px-0">
        <!-- Page Header -->
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('admin.promotions.index') }}" class="text-gray-500 hover:text-gray-700">โปรโมชัน</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-500 ml-1 md:ml-2">{{ $promotion->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $promotion->title }}</h2>
                    <div class="mt-2 flex items-center space-x-4">
                        @if($promotion->is_active && $promotion->is_current)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">
                                เปิดใช้งาน
                            </span>
                        @elseif($promotion->is_active && $promotion->start_date && $promotion->start_date > now())
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                                รอเวลาเริ่ม
                            </span>
                        @elseif($promotion->is_active)
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm font-medium">
                                หมดเวลา
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-sm font-medium">
                                ปิดใช้งาน
                            </span>
                        @endif
                        <span class="text-sm text-gray-500">ลำดับ: {{ $promotion->sort_order }}</span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.promotions.edit', $promotion) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        แก้ไข
                    </a>
                    <form action="{{ route('admin.promotions.destroy', $promotion) }}" 
                          method="POST" 
                          class="inline"
                          onsubmit="return confirm('ต้องการลบโปรโมชันนี้หรือไม่?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg">
                            ลบ
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Promotion Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Promotion Banner -->
                <div class="bg-white rounded-lg shadow mb-6">
                    @if($promotion->image)
                        <img src="{{ $promotion->image_url }}" 
                             alt="{{ $promotion->title }}" 
                             class="w-full h-64 object-cover rounded-t-lg">
                    @else
                        <div class="w-full h-64 bg-gradient-to-r from-blue-500 to-blue-600 rounded-t-lg flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <h3 class="text-xl font-bold">{{ $promotion->title }}</h3>
                            </div>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">เนื้อหาโปรโมชัน</h3>
                        <div class="prose prose-sm max-w-none">
                            {!! $promotion->content !!}
                        </div>
                        
                        @if($promotion->link_url && $promotion->link_url !== '#')
                            <div class="mt-6">
                                <a href="{{ $promotion->link_url }}" 
                                   target="_blank"
                                   class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium py-3 px-6 rounded-lg inline-flex items-center">
                                    {{ $promotion->button_text }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-1">
                <!-- Promotion Details -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">รายละเอียด</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">วันที่สร้าง</dt>
                            <dd class="text-sm text-gray-900">{{ $promotion->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">อัพเดทล่าสุด</dt>
                            <dd class="text-sm text-gray-900">{{ $promotion->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        @if($promotion->start_date)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">วันที่เริ่มต้น</dt>
                                <dd class="text-sm text-gray-900">{{ $promotion->start_date->format('d/m/Y H:i') }}</dd>
                            </div>
                        @endif
                        @if($promotion->end_date)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">วันที่สิ้นสุด</dt>
                                <dd class="text-sm text-gray-900">{{ $promotion->end_date->format('d/m/Y H:i') }}</dd>
                            </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">ลำดับการแสดง</dt>
                            <dd class="text-sm text-gray-900">{{ $promotion->sort_order }}</dd>
                        </div>
                        @if($promotion->link_url)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">ลิงก์</dt>
                                <dd class="text-sm text-gray-900">
                                    <a href="{{ $promotion->link_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 break-all">
                                        {{ $promotion->link_url }}
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- Preview on Site -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">ตัวอย่างบนเว็บไซต์</h3>
                    <a href="{{ route('dashboard') }}" 
                       target="_blank"
                       class="text-blue-600 hover:text-blue-800 text-sm">
                        ดูบนหน้าแรก →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection