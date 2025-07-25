@extends('layouts.admin')

@section('title', 'Admin Dashboard - Marco Air')

@section('content')
    <div class="px-4 py-6 sm:px-0">
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">แดชบอร์ด</h2>
            <p class="text-gray-600">ภาพรวมของระบบ Marco Air</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">ผู้ใช้ทั้งหมด</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">ลูกค้า</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_customers']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Dealers -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">ตัวแทนจำหน่าย</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_dealers']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Promotions -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">โปรโมชันที่ใช้งานอยู่</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['current_promotions']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Users -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">ผู้ใช้ล่าสุด</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recent_users as $user)
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if($user->line_avatar)
                                        <img class="h-8 w-8 rounded-full" src="{{ $user->line_avatar }}" alt="{{ $user->name }}">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            @if($user->role === 'admin')
                                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Admin</span>
                                            @elseif($user->role === 'dealer')
                                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">Dealer</span>
                                            @else
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Customer</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-4 text-center text-gray-500">
                            ไม่มีข้อมูลผู้ใช้
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Promotions -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">โปรโมชันล่าสุด</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recent_promotions as $promotion)
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $promotion->title }}</p>
                                    <p class="text-sm text-gray-500">
                                        @if($promotion->is_active)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">เปิดใช้งาน</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">ปิดใช้งาน</span>
                                        @endif
                                    </p>
                                </div>
                                <p class="text-sm text-gray-500">{{ $promotion->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-4 text-center text-gray-500">
                            ไม่มีข้อมูลโปรโมชัน
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection