@extends('layouts.app')

@section('title', 'อยู่ระหว่างรออนุมัติ - Marco Air')

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
                <h1 class="font-bold text-lg">อยู่ระหว่างรออนุมัติ</h1>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 px-4 py-6 overflow-y-auto bg-gray-50">
            <!-- Customer Info Card -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                <h2 class="font-bold text-lg text-gray-900 mb-4">ข้อมูลติดต่อลูกค้า</h2>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">ชื่อ-นามสกุล</span>
                        <span class="font-medium text-gray-900">ศักดา ทุนดิษ</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">หมายเลขโกร์ศพท์</span>
                        <span class="font-medium text-gray-900">056 567 7890</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">อีเมล</span>
                        <span class="font-medium text-gray-900">ccc2@yahoo.com</span>
                    </div>
                </div>
            </div>

            <!-- Service Details Card -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                <h2 class="font-bold text-lg text-gray-900 mb-4">ที่อยู่จัดส่งหรือใช้บริการ</h2>
                
                <div class="text-gray-600 text-sm leading-relaxed">
                    64 ถนน รัตนธิเบศร์ ตำบล บางรักน้อย<br>
                    อำเภอเมืองนนทบุรี นนทบุรี 11000
                </div>
            </div>

            <!-- Date & Time Card -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                <h2 class="font-bold text-lg text-gray-900 mb-4">วันและเวลานัดรับบริการ</h2>
                
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium">13 ม.ค. 2567</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium">13:00-17:00 น.</span>
                    </div>
                </div>
            </div>

            <!-- Additional Notes Card -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                <h2 class="font-bold text-lg text-gray-900 mb-4">หมายเหตุถึงทีมช่าง</h2>
                
                <div class="text-gray-600 text-sm">
                    โทรแจ้งก่อนเข้ามา 20 นาที
                </div>
            </div>

            <!-- Service Summary Card -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h2 class="font-bold text-lg text-gray-900 mb-4">รายการสินค้าหรือการบริการ</h2>
                
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <img src="https://placehold.co/48x48" alt="AC Service" class="w-full h-full rounded-lg object-cover">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-900 mb-1">ล้างแอร์ติดผนัง</h3>
                        <p class="text-sm text-gray-600 mb-2">panasonic / BTU12,000</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-600 font-bold text-lg">650 บาท</span>
                            <span class="text-gray-600 text-sm">(1เครื่อง)</span>
                        </div>
                    </div>
                </div>

                <!-- Update Progress Link -->
                <div class="pt-4 border-t border-gray-200">
                    <a href="#" class="text-blue-600 text-sm font-medium underline">
                        บันทึกการช่อมบำรุงสินค้า
                    </a>
                </div>
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.dealer-bottom-navigation')
    </div>
@endsection