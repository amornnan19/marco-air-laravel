@extends('layouts.admin')

@section('title', 'ดูบริการ: ' . $service->name)

@section('content')
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $service->name }}</h1>
                <p class="mt-1 text-sm text-gray-600">รายละเอียดบริการ</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.services.edit', $service) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    แก้ไข
                </a>
                <a href="{{ route('admin.services.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg">
                    กลับ
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">ข้อมูลพื้นฐาน</h2>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">ชื่อบริการ</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Slug</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->slug }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">สีไอคอน</label>
                            <div class="mt-1 flex items-center space-x-2">
                                <div class="w-4 h-4 rounded bg-{{ $service->icon_color }}-500"></div>
                                <span class="text-sm text-gray-900 capitalize">{{ $service->icon_color }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">เบอร์ติดต่อ</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->contact_phone ?: 'ไม่ระบุ' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">ราคาแสดง</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $service->price_display ? number_format($service->price_display) . ' บาท' : 'ไม่ระบุ' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">ลำดับการแสดง</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->sort_order }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500">คำอธิบาย</label>
                        <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $service->description }}</p>
                    </div>

                    @if ($service->hero_image_url)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-500 mb-2">รูปภาพหลัก</label>
                            <img src="{{ $service->hero_image_url }}" alt="{{ $service->name }}"
                                class="max-w-md rounded-lg shadow-sm">
                        </div>
                    @endif
                </div>

                <!-- Service Packages -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">แพ็กเกจบริการ</h2>
                    
                    @if ($service->packages && count($service->packages) > 0)
                        <div class="space-y-4">
                            @foreach ($service->packages as $index => $package)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-md font-medium text-gray-900">{{ $package['name'] ?? 'แพ็กเกจ ' . ($index + 1) }}</h3>
                                        <span class="text-lg font-bold text-blue-600">
                                            {{ number_format($package['price'] ?? 0) }} บาท/{{ $package['unit'] ?? 'ครั้ง' }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $package['description'] ?? 'ไม่มีรายละเอียด' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">ยังไม่มีแพ็กเกจบริการ</p>
                    @endif
                </div>

                <!-- Service Details -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">รายละเอียดบริการ</h2>
                    
                    @if ($service->details && count($service->details) > 0)
                        <ul class="list-disc pl-5 space-y-2">
                            @foreach ($service->details as $detail)
                                <li class="text-sm text-gray-700">{{ $detail }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500">ยังไม่มีรายละเอียดบริการ</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">สถานะ</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">สถานะการใช้งาน</label>
                            <div class="mt-1">
                                @if ($service->is_active)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        เปิดใช้งาน
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        ปิดใช้งาน
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">วันที่สร้าง</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">วันที่แก้ไขล่าสุด</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">สถิติ</h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">จำนวนแพ็กเกจ</span>
                            <span class="text-sm text-gray-900">{{ count($service->packages ?? []) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">รายละเอียด</span>
                            <span class="text-sm text-gray-900">{{ count($service->details ?? []) }} รายการ</span>
                        </div>

                        @if ($service->packages && count($service->packages) > 0)
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-500">ราคาต่ำสุด</span>
                                <span class="text-sm text-gray-900">
                                    {{ number_format(min(array_column($service->packages, 'price'))) }} บาท
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-500">ราคาสูงสุด</span>
                                <span class="text-sm text-gray-900">
                                    {{ number_format(max(array_column($service->packages, 'price'))) }} บาท
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Preview Link -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">ตัวอย่าง</h2>
                    
                    @if ($service->is_active)
                        <a href="{{ route('service.show', $service->slug) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            ดูหน้าบริการ
                        </a>
                    @else
                        <p class="text-sm text-gray-500">บริการถูกปิดใช้งาน ไม่สามารถดูตัวอย่างได้</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection