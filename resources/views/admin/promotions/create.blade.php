@extends('layouts.admin')

@section('title', 'เพิ่มโปรโมชันใหม่ - Admin Panel')

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
                            <span class="text-gray-500 ml-1 md:ml-2">เพิ่มโปรโมชันใหม่</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-gray-900">เพิ่มโปรโมชันใหม่</h2>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg">
            <form action="{{ route('admin.promotions.store') }}" method="POST" class="space-y-6 p-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">ชื่อโปรโมชัน *</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">เนื้อหาโปรโมชัน *</label>
                    <textarea name="content" 
                              id="content" 
                              rows="4"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('content') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">อธิบายรายละเอียดโปรโมชัน</p>
                </div>

                <!-- Image Path -->
                <div>
                    <label for="image_path" class="block text-sm font-medium text-gray-700">ลิงก์รูปภาพ</label>
                    <input type="url" 
                           name="image_path" 
                           id="image_path" 
                           value="{{ old('image_path') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="https://example.com/image.jpg">
                    <p class="mt-1 text-sm text-gray-500">URL ของรูปภาพโปรโมชัน (ถ้าไม่มีจะใช้สีพื้นหลังแทน)</p>
                </div>

                <!-- Link URL & Button Text -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="link_url" class="block text-sm font-medium text-gray-700">ลิงก์ปุ่ม</label>
                        <input type="url" 
                               name="link_url" 
                               id="link_url" 
                               value="{{ old('link_url') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               placeholder="https://example.com">
                    </div>
                    <div>
                        <label for="button_text" class="block text-sm font-medium text-gray-700">ข้อความปุ่ม *</label>
                        <input type="text" 
                               name="button_text" 
                               id="button_text" 
                               value="{{ old('button_text', 'ดูรายละเอียด') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">วันที่เริ่มต้น</label>
                        <input type="datetime-local" 
                               name="start_date" 
                               id="start_date" 
                               value="{{ old('start_date') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">วันที่สิ้นสุด</label>
                        <input type="datetime-local" 
                               name="end_date" 
                               id="end_date" 
                               value="{{ old('end_date') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Sort Order & Active -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700">ลำดับการแสดง *</label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               value="{{ old('sort_order', 1) }}"
                               min="0"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <p class="mt-1 text-sm text-gray-500">เลขน้อยแสดงก่อน</p>
                    </div>
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700">สถานะ</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">เปิดใช้งาน</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.promotions.index') }}" 
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        ยกเลิก
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        สร้างโปรโมชัน
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection