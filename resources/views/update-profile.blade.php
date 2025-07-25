<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Marco Air</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-sm mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4">
                    @if(auth()->user()->line_avatar)
                        <img src="{{ auth()->user()->line_avatar }}" alt="Profile" class="w-16 h-16 rounded-full object-cover border-2 border-blue-200">
                    @else
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Complete Your Profile</h1>
                <p class="text-gray-600">Please provide your information to continue</p>
            </div>

            <!-- Profile Form -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                            ชื่อจริง <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="first_name" 
                            name="first_name" 
                            value="{{ old('first_name', auth()->user()->first_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                            นามสกุล <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="last_name" 
                            name="last_name" 
                            value="{{ old('last_name', auth()->user()->last_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                            เบอร์โทรศัพท์ <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            value="{{ old('phone', auth()->user()->phone) }}"
                            placeholder="0812345678"
                            maxlength="10"
                            pattern="[0-9]{10}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required
                        >
                        <p class="text-xs text-gray-500 mt-1">กรอกตัวเลข 10 หลัก (เช่น 0812345678)</p>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors mt-6"
                    >
                        บันทึกข้อมูล
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>