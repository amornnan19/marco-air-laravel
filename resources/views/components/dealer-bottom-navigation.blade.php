<nav
    class="fixed bottom-0 left-0 right-0 sm:absolute sm:bottom-0 sm:left-0 sm:right-0 bg-white border-t border-gray-200 px-4 py-2">
    <div class="max-w-md mx-auto">
        <div class="flex justify-around">
            <!-- หน้าหลัก -->
            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center py-2 px-3 @if (request()->routeIs('dashboard')) text-blue-600 @else text-gray-500 @endif">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                <span class="text-xs @if (request()->routeIs('dashboard')) font-medium @endif">หน้าหลัก</span>
            </a>

            <!-- สถานะงาน -->
            <a href="#" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                <span class="text-xs">สถานะงาน</span>
            </a>

            <!-- โปรไฟล์ -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex flex-col items-center py-2 px-3 text-gray-500">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-xs">โปรไฟล์</span>
                </button>
            </form>
        </div>
    </div>
</nav>
