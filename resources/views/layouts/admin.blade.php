<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Marco Air')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Quill.js CDN -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Navigation -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold text-gray-900">Marco Air Admin</h1>
                    </div>
                    <nav class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                                  @if (request()->routeIs('admin.dashboard')) text-blue-600 border-blue-600 
                                  @else 
                                      text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300 @endif">
                            แดชบอร์ด
                        </a>
                        <a href="{{ route('admin.promotions.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                                  @if (request()->routeIs('admin.promotions.*')) text-blue-600 border-blue-600 
                                  @else 
                                      text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300 @endif">
                            โปรโมชัน
                        </a>
                    </nav>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                            ออกจากระบบ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </main>
</body>

</html>
