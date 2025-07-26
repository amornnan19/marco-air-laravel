@extends('layouts.admin')

@section('title', 'เพิ่มสินค้าใหม่')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">เพิ่มสินค้าใหม่</h1>
            <a href="{{ route('admin.products.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                กลับ
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ข้อมูลพื้นฐาน</h3>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">ชื่อสินค้า *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700">รุ่น</label>
                        <input type="text" name="model" id="model" value="{{ old('model') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700">ยี่ห้อ</label>
                        <select name="brand" id="brand" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">เลือกยี่ห้อ</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ old('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="btu" class="block text-sm font-medium text-gray-700">BTU</label>
                        <input type="text" name="btu" id="btu" value="{{ old('btu') }}"
                               placeholder="เช่น 12,000 BTU"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">ราคา (บาท) *</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" required
                               min="0" step="0.01"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">หมวดหมู่ *</label>
                        <select name="category" id="category" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">เลือกหมวดหมู่</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Image Upload -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">รูปภาพสินค้า</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 2MB</p>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">รายละเอียดสินค้า</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    </div>

                    <!-- Features -->
                    <div class="md:col-span-2">
                        <label for="features" class="block text-sm font-medium text-gray-700">คุณสมบัติเด่น</label>
                        <textarea name="features" id="features" rows="6"
                                  placeholder="ใส่คุณสมบัติทีละบรรทัด เช่น:&#10;Real Inverter อินเวอร์เตอร์แท้จากประเทศญี่ปุ่น&#10;Fan Speed (ระดับความเร็วพัดลม): 5 ระดับ"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('features') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">ใส่คุณสมบัติทีละบรรทัด</p>
                    </div>

                    <!-- Specifications -->
                    <div class="md:col-span-2">
                        <label for="specifications" class="block text-sm font-medium text-gray-700">ข้อมูลทางเทคนิค</label>
                        <textarea name="specifications" id="specifications" rows="6"
                                  placeholder="ใส่ข้อมูลทางเทคนิคในรูปแบบ key: value ทีละบรรทัด เช่น:&#10;ขนาดความเย็น: 15,480 BTU/hr&#10;ระบบ: Inverter&#10;สารทำความเย็น: R32"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('specifications') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">ใส่ข้อมูลในรูปแบบ "หัวข้อ: ค่า" ทีละบรรทัด</p>
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">สถานะ</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" value="1" 
                                       {{ old('is_active', 1) ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    เปิดใช้งาน
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                                       {{ old('is_featured') ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                    สินค้าแนะนำ
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.products.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        ยกเลิก
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection