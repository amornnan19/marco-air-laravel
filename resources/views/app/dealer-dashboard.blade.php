@extends('layouts.app')

@section('title', 'Dealer Dashboard - Marco Air')

@section('content')
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
            <div class="max-w-md mx-auto">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        @if (auth()->user()->line_avatar)
                            <img src="{{ auth()->user()->line_avatar }}" alt="Profile"
                                class="w-12 h-12 rounded-full border-2 border-white/20">
                        @else
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h1 class="font-medium text-sm">สินค้าต้องรับ</h1>
                            <h2 class="font-bold text-lg">สไนเปอร์แอร์ แอนด์เซอร์วิส</h2>
                        </div>
                    </div>
                    <button class="p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zM12 13a1 1 0 110-2 1 1 0 010 2zM12 20a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Search Bar -->
                <div class="relative bg-white">
                    <input type="text" placeholder="รหัสสั่งซื้อ/สั่งงาน" 
                        class="w-full px-4 py-3 pr-12 rounded-lg text-gray-900 placeholder-gray-500">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 pb-20 overflow-y-auto">
            <!-- Filter Pills -->
            <div class="py-4">
                <div class="flex gap-2 overflow-x-auto scrollbar-hide">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap">
                        ทั้งหมด
                    </button>
                    <button class="bg-gray-100 text-gray-600 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap">
                        ล้างแอร์
                    </button>
                    <button class="bg-gray-100 text-gray-600 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap">
                        ซ่อมแอร์
                    </button>
                    <button class="bg-gray-100 text-gray-600 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap">
                        ฯลฯ
                    </button>
                </div>
            </div>

            <!-- Order Cards -->
            <div class="space-y-3">
                <!-- Order Card 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <img src="https://placehold.co/48x48" alt="Tech" class="w-full h-full rounded-lg object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="font-medium text-gray-900">ล้างแอร์ติดผนัง</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                        อยู่ระหว่างรออนุมัติ
                                    </span>
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>วันที่</span>
                                        <span class="font-medium">13 ม.ค. 2567</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>รหัสสำลิงต์</span>
                                        <span class="font-medium">NG-456234599</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ชื่อสินค้า</span>
                                        <span class="font-medium">panasonic/ 12,000 btu</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>จำนวน (เครื่อง)</span>
                                        <span class="font-medium">1</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ราคา</span>
                                        <span class="font-medium">650 บาท</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Card 2 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <img src="https://placehold.co/48x48" alt="Tech" class="w-full h-full rounded-lg object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="font-medium text-gray-900">ซ่อมแอร์ติดผนัง</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                        อยู่ระหว่างซ่อม
                                    </span>
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>วันที่</span>
                                        <span class="font-medium">12 ม.ค. 2567</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>รหัสสำลิงต์</span>
                                        <span class="font-medium">NG-456234599</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ชื่อสินค้า</span>
                                        <span class="font-medium">tanin/ 9,000 btu</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>จำนวน (เครื่อง)</span>
                                        <span class="font-medium">2</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ราคา</span>
                                        <span class="font-medium">650 บาท</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Card 3 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <img src="https://placehold.co/48x48" alt="Mitsubishi" class="w-full h-full rounded-lg object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="font-medium text-gray-900">ติดตั้งแอร์</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                        อยู่ระหว่างรออนุมัติ
                                    </span>
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>วันที่</span>
                                        <span class="font-medium">11 ม.ค. 2567</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>รหัสสำลิงต์</span>
                                        <span class="font-medium">NG-456234599</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ชื่อสินค้า</span>
                                        <span class="font-medium">แอร์ Mitsubishi Heavy Duty ติดตั้ง รรปแอร์ Mitsubishi Heavy Duty ติดตั้ง ร Inverter รุ่น DXK15YW-W1แอร์ติดผนัง</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>จำนวน (เครื่อง)</span>
                                        <span class="font-medium">1</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ราคา</span>
                                        <span class="font-medium">11,990 บาท</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Card 4 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <img src="https://placehold.co/48x48" alt="Singer" class="w-full h-full rounded-lg object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="font-medium text-gray-900">ถอด,ย้ายแอร์</h3>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                        เสร็จสิ้น
                                    </span>
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>วันที่</span>
                                        <span class="font-medium">9 ม.ค. 2567</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>รหัสสำลิงต์</span>
                                        <span class="font-medium">NG-456234599</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ชื่อสินค้า</span>
                                        <span class="font-medium">Singer /18,000 BTU</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>จำนวน (เครื่อง)</span>
                                        <span class="font-medium">1</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>ราคา</span>
                                        <span class="font-medium">4,500 บาท</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.dealer-bottom-navigation')
    </div>
@endsection
