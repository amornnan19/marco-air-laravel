<nav class="fixed bottom-0 left-0 right-0 sm:absolute sm:bottom-0 sm:left-0 sm:right-0 bg-white border-t border-gray-200 px-4 py-2">
    <div class="max-w-md mx-auto">
        <div class="flex justify-around">
            <!-- Home -->
            <a href="#" class="flex flex-col items-center py-2 px-3 text-blue-600">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                <span class="text-xs font-medium">หน้าแรก</span>
            </a>

            <!-- Services -->
            <a href="#" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                <span class="text-xs">บริการ</span>
            </a>

            <!-- Chat -->
            <a href="#" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
                <span class="text-xs">แชท</span>
            </a>

            <!-- Articles -->
            <a href="#" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <span class="text-xs">บทความ</span>
            </a>

            <!-- Profile -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex flex-col items-center py-2 px-3 text-gray-500">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-xs">โปรไฟล์</span>
                    </a>
            </form>
        </div>
    </div>
</nav>
