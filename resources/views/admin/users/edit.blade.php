@extends('layouts.admin')

@section('title', 'แก้ไขผู้ใช้ - Admin')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">แก้ไขผู้ใช้</h2>
                <p class="text-gray-600">แก้ไขข้อมูลและสิทธิ์ของผู้ใช้</p>
            </div>
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                ← กลับ
            </a>
        </div>

        <!-- User Info Card -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                @if ($user->line_avatar)
                    <img class="h-16 w-16 rounded-full" src="{{ $user->line_avatar }}" alt="{{ $user->name }}">
                @else
                    <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                        <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                @endif
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500">สมาชิกตั้งแต่: {{ $user->created_at->format('d/m/Y') }}</p>
                    @if ($user->line_id)
                        <p class="text-xs text-gray-500">LINE ID: {{ $user->line_id }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        ชื่อในระบบ <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        อีเมล <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">ชื่อจริง</label>
                    <input type="text" name="first_name" id="first_name" 
                        value="{{ old('first_name', $user->first_name) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">นามสกุล</label>
                    <input type="text" name="last_name" id="last_name" 
                        value="{{ old('last_name', $user->last_name) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">เบอร์โทรศัพท์</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                        สิทธิ์ <span class="text-red-500">*</span>
                    </label>
                    <select name="role" id="role"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>ลูกค้า</option>
                        <option value="dealer" {{ old('role', $user->role) == 'dealer' ? 'selected' : '' }}>ตัวแทน</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>ผู้ดูแลระบบ</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">ข้อมูลเพิ่มเติม</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <strong>ยอมรับเงื่อนไข:</strong>
                        {{ $user->terms_accepted ? 'ยอมรับแล้ว' : 'ยังไม่ยอมรับ' }}
                        @if ($user->terms_accepted_at)
                            ({{ $user->terms_accepted_at->format('d/m/Y H:i') }})
                        @endif
                    </div>
                    <div>
                        <strong>การตลาด:</strong>
                        {{ $user->marketing_consent ? 'ยินยอม' : 'ไม่ยินยอม' }}
                    </div>
                    <div>
                        <strong>การแชร์ข้อมูล:</strong>
                        {{ $user->data_sharing_consent ? 'ยินยอม' : 'ไม่ยินยอม' }}
                    </div>
                    <div>
                        <strong>อัพเดทล่าสุด:</strong>
                        {{ $user->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    บันทึกการเปลี่ยนแปลง
                </button>
            </div>
        </form>
    </div>
</div>
@endsection