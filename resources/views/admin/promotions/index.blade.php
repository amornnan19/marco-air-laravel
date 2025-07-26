@extends('layouts.admin')

@section('title', 'จัดการโปรโมชัน - Admin Panel')

@section('content')
    <div class="px-4 py-6 sm:px-0">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">จัดการโปรโมชัน</h2>
                <p class="text-gray-600">สร้าง แก้ไข และจัดการโปรโมชันทั้งหมด</p>
            </div>
            <a href="{{ route('admin.promotions.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                เพิ่มโปรโมชันใหม่
            </a>
        </div>

        <!-- Promotions Table -->
        <div class="bg-white shadow rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                โปรโมชัน
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                สถานะ
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                วันที่
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ลำดับ
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                จัดการ
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($promotions as $promotion)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($promotion->image)
                                                <img class="h-12 w-12 rounded-lg object-cover" src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}">
                                            @else
                                                <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $promotion->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($promotion->content), 60) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($promotion->is_active && $promotion->is_current)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                            เปิดใช้งาน
                                        </span>
                                    @elseif($promotion->is_active && $promotion->start_date && $promotion->start_date > now())
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                            รอเวลาเริ่ม
                                        </span>
                                    @elseif($promotion->is_active)
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                            หมดเวลา
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-medium">
                                            ปิดใช้งาน
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>
                                        @if($promotion->start_date)
                                            เริ่ม: {{ $promotion->start_date->format('d/m/Y') }}
                                        @endif
                                    </div>
                                    <div>
                                        @if($promotion->end_date)
                                            สิ้นสุด: {{ $promotion->end_date->format('d/m/Y') }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $promotion->sort_order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.promotions.show', $promotion) }}" 
                                           class="text-blue-600 hover:text-blue-900">ดู</a>
                                        <a href="{{ route('admin.promotions.edit', $promotion) }}" 
                                           class="text-indigo-600 hover:text-indigo-900">แก้ไข</a>
                                        <form action="{{ route('admin.promotions.destroy', $promotion) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('ต้องการลบโปรโมชันนี้หรือไม่?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">ลบ</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <p class="mt-2 text-sm">ยังไม่มีโปรโมชัน</p>
                                        <p class="text-xs text-gray-400 mt-1">เริ่มต้นสร้างโปรโมชันแรกของคุณ</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($promotions->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $promotions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection