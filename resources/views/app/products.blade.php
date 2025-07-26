@extends('layouts.app')

@section('title', 'ผลิตภัณฑ์ - Marco Air')

@section('content')
    <div class="flex flex-col h-full">
        <!-- User Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
            <div class="max-w-md mx-auto flex items-center justify-between">
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
                        <h2 class="font-bold text-lg">ศักดา ทุนดิษ</h2>
                    </div>
                </div>
                <div class="relative">
                    <button class="p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 00-15 0v5h5l-5 5-5-5h5V7a9.5 9.5 0 0119 0v10z"></path>
                        </svg>
                    </button>
                    <!-- Notification Badge -->
                    <div
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 max-w-md mx-auto px-4 pb-20 overflow-y-auto min-w-0 w-full">
            <!-- Promotion Banner -->
            @if ($promotions && $promotions->count() > 0)
                <div class="py-4">
                    <div class="relative bg-white rounded-lg shadow-sm overflow-hidden">
                        <!-- Promotion Carousel -->
                        <div class="relative h-48 overflow-hidden">
                            @foreach ($promotions as $index => $promotion)
                                <div class="promotion-slide absolute inset-0 transition-transform duration-300 ease-in-out {{ $index === 0 ? 'translate-x-0' : 'translate-x-full' }}"
                                    data-slide="{{ $index }}">
                                    @if ($promotion->image)
                                        <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}"
                                            class="w-full h-48 object-cover">
                                    @else
                                        <div
                                            class="w-full h-48 bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                            <div class="text-center text-white p-6">
                                                <h3 class="text-lg font-bold mb-2">{{ $promotion->title }}</h3>
                                                <p class="text-sm opacity-90">
                                                    {{ Str::limit(strip_tags($promotion->content), 100) }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($promotion->link_url && $promotion->button_text)
                                        <div class="absolute inset-0 bg-black/20 flex items-end">
                                            <div class="p-4 w-full">
                                                <button onclick="window.open('{{ $promotion->link_url }}', '_blank')"
                                                    class="bg-white text-blue-600 px-4 py-2 rounded font-medium text-sm hover:bg-blue-50 transition-colors">
                                                    {{ $promotion->button_text }}
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Carousel Indicators -->
                        @if ($promotions->count() > 1)
                            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2">
                                <div class="flex space-x-2">
                                    @foreach ($promotions as $index => $promotion)
                                        <button
                                            class="indicator w-2 h-2 rounded-full transition-colors {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"
                                            onclick="showSlide({{ $index }})"
                                            data-indicator="{{ $index }}"></button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Navigation Arrows -->
                            <button
                                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/30 text-white p-2 rounded-full hover:bg-black/50 transition-colors"
                                onclick="prevSlide()">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/30 text-white p-2 rounded-full hover:bg-black/50 transition-colors"
                                onclick="nextSlide()">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Product Filters -->
            <form id="filter-form" method="GET" action="{{ route('products.index') }}">
                <div class="py-4 space-y-4">
                    <!-- Search Bar -->
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="ค้นหาสินค้า เช่น แอร์ Mitsubishi, 12000 BTU..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                onkeyup="debounceSearch(this.value)">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-semibold text-gray-900 text-sm">ตัวกรอง</h3>
                            <button type="button" onclick="clearAllFilters()" class="text-blue-600 text-xs font-medium">ล้างทั้งหมด</button>
                        </div>
                        
                        <!-- Hidden inputs for filters -->
                        <input type="hidden" name="category" id="category-input" value="{{ request('category', 'all') }}">
                        <input type="hidden" name="brand" id="brand-input" value="{{ request('brand') }}">
                        <input type="hidden" name="min_price" id="min-price-input" value="{{ request('min_price') }}">
                        <input type="hidden" name="max_price" id="max-price-input" value="{{ request('max_price') }}">
                        <input type="hidden" name="sort" id="sort-input" value="{{ request('sort', 'featured') }}">
                        
                        <!-- Category Filters -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <button type="button" onclick="setCategory('all')" 
                                class="category-btn px-3 py-2 text-xs font-medium rounded-full {{ request('category', 'all') === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                ทั้งหมด
                            </button>
                            @foreach($categories as $category)
                                <button type="button" onclick="setCategory('{{ $category }}')" 
                                    class="category-btn px-3 py-2 text-xs font-medium rounded-full {{ request('category') === $category ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                    {{ $category }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Quick Filters -->
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Brand Filter -->
                            <div class="relative">
                                <button type="button" onclick="toggleDropdown('brand-dropdown')" 
                                    class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ request('brand') ? request('brand') : 'ยี่ห้อ' }}
                                        </span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Brand Dropdown -->
                                <div id="brand-dropdown" class="hidden absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-10 max-h-48 overflow-y-auto">
                                    <button type="button" onclick="setBrand('')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100">ทั้งหมด</button>
                                    @foreach($brands as $brand)
                                        <button type="button" onclick="setBrand('{{ $brand }}')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100">{{ $brand }}</button>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Price Filter -->
                            <div class="relative">
                                <button type="button" onclick="toggleDropdown('price-dropdown')" 
                                    class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">ราคา</span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Price Dropdown -->
                                <div id="price-dropdown" class="hidden absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-10 max-h-48 overflow-y-auto">
                                    <button type="button" onclick="setPriceRange('', '')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 {{ !request('min_price') && !request('max_price') ? 'bg-blue-50 text-blue-600' : '' }}">
                                        ทุกราคา
                                    </button>
                                    <button type="button" onclick="setPriceRange('0', '10000')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 {{ request('min_price') == '0' && request('max_price') == '10000' ? 'bg-blue-50 text-blue-600' : '' }}">
                                        ต่ำกว่า 10,000 บาท
                                    </button>
                                    <button type="button" onclick="setPriceRange('10000', '20000')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 {{ request('min_price') == '10000' && request('max_price') == '20000' ? 'bg-blue-50 text-blue-600' : '' }}">
                                        10,000 - 20,000 บาท
                                    </button>
                                    <button type="button" onclick="setPriceRange('20000', '30000')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 {{ request('min_price') == '20000' && request('max_price') == '30000' ? 'bg-blue-50 text-blue-600' : '' }}">
                                        20,000 - 30,000 บาท
                                    </button>
                                    <button type="button" onclick="setPriceRange('30000', '50000')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 {{ request('min_price') == '30000' && request('max_price') == '50000' ? 'bg-blue-50 text-blue-600' : '' }}">
                                        30,000 - 50,000 บาท
                                    </button>
                                    <button type="button" onclick="setPriceRange('50000', '100000')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 {{ request('min_price') == '50000' && request('max_price') == '100000' ? 'bg-blue-50 text-blue-600' : '' }}">
                                        50,000 - 100,000 บาท
                                    </button>
                                    <button type="button" onclick="setPriceRange('100000', '')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 {{ request('min_price') == '100000' && !request('max_price') ? 'bg-blue-50 text-blue-600' : '' }}">
                                        มากกว่า 100,000 บาท
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">เรียงลำดับ</span>
                            <select name="sort" onchange="submitForm()" class="text-sm text-blue-600 font-medium bg-transparent border-none focus:ring-0">
                                <option value="featured" {{ request('sort', 'featured') === 'featured' ? 'selected' : '' }}>แนะนำ</option>
                                <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>ราคา: น้อย → มาก</option>
                                <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>ราคา: มาก → น้อย</option>
                                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>ล่าสุด</option>
                                <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>ยอดนิยม</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Product Grid -->
            <div class="py-4">
                @if($products->count() === 0)
                    <!-- No results message -->
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.347 0-4.515.862-6.172 2.172M12 3v12"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">ไม่พบสินค้าที่ตรงกับเงื่อนไข</h3>
                        <p class="text-gray-600 mb-4">ลองค้นหาด้วยคำอื่น หรือปรับเงื่อนไขการกรอง</p>
                        <button onclick="clearAllFilters()" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            ล้างตัวกรอง
                        </button>
                    </div>
                @else
                    <!-- Results Count -->
                    <div class="mb-4">
                        <span class="text-sm text-gray-600">
                            พบสินค้า {{ $products->count() }} รายการ
                            @if(request('search'))
                                จากการค้นหา "{{ request('search') }}"
                            @endif
                        </span>
                    </div>

                    <!-- Product Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden cursor-pointer"
                                onclick="window.location.href='{{ route('product.detail', $product->id) }}'">
                                @if ($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                        class="w-full h-32 object-cover">
                                @else
                                    <img src="https://placehold.co/200x150/E5E7EB/6B7280?text={{ urlencode($product->brand . '+' . $product->name) }}"
                                        alt="{{ $product->name }}" class="w-full h-32 object-cover">
                                @endif
                                <div class="p-3">
                                    <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $product->name }}</h3>
                                    @if ($product->model)
                                        <p class="text-xs text-gray-600 mb-1">{{ $product->model }}</p>
                                    @endif
                                    @if ($product->btu)
                                        <p class="text-xs text-gray-600 mb-2">{{ $product->btu }}</p>
                                    @endif
                                    <p class="text-red-600 font-bold text-sm">{{ $product->formatted_price }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>

        <!-- Sticky Bottom Navigation -->
        @include('components.sticky-bottom-navigation')
    </div>

    <script>
        // Promotion carousel functionality
        @if ($promotions && $promotions->count() > 1)
            let currentSlide = 0;
            const totalSlides = {{ $promotions->count() }};

            function showSlide(index) {
                currentSlide = index;

                // Hide all slides
                document.querySelectorAll('.promotion-slide').forEach((slide, i) => {
                    slide.style.transform = i === index ? 'translateX(0)' : 'translateX(100%)';
                });

                // Update indicators
                document.querySelectorAll('.indicator').forEach((indicator, i) => {
                    indicator.classList.toggle('bg-white', i === index);
                    indicator.classList.toggle('bg-white/50', i !== index);
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            }

            // Auto-play carousel every 5 seconds
            setInterval(() => {
                nextSlide();
            }, 5000);
        @endif

        // Filter functionality
        let searchTimeout;

        function debounceSearch(value) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                submitForm();
            }, 500);
        }

        function setCategory(category) {
            document.getElementById('category-input').value = category;
            updateCategoryButtons(category);
            submitForm();
        }

        function updateCategoryButtons(activeCategory) {
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });
            
            // Find and activate the selected button
            const activeBtn = [...document.querySelectorAll('.category-btn')].find(btn => {
                return btn.textContent.trim() === activeCategory || 
                       (activeCategory === 'all' && btn.textContent.trim() === 'ทั้งหมด');
            });
            
            if (activeBtn) {
                activeBtn.classList.remove('bg-gray-100', 'text-gray-700');
                activeBtn.classList.add('bg-blue-600', 'text-white');
            }
        }

        function setBrand(brand) {
            document.getElementById('brand-input').value = brand;
            toggleDropdown('brand-dropdown');
            submitForm();
        }

        function setPriceRange(minPrice = '', maxPrice = '') {
            document.getElementById('min-price-input').value = minPrice;
            document.getElementById('max-price-input').value = maxPrice;
            
            toggleDropdown('price-dropdown');
            submitForm();
        }

        function toggleDropdown(dropdownId) {
            // Close all other dropdowns
            document.querySelectorAll('[id$="-dropdown"]').forEach(dropdown => {
                if (dropdown.id !== dropdownId) {
                    dropdown.classList.add('hidden');
                }
            });
            
            // Toggle target dropdown
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        function clearAllFilters() {
            document.getElementById('category-input').value = 'all';
            document.getElementById('brand-input').value = '';
            document.getElementById('min-price-input').value = '';
            document.getElementById('max-price-input').value = '';
            document.getElementById('sort-input').value = 'featured';
            document.querySelector('input[name="search"]').value = '';
            
            updateCategoryButtons('all');
            submitForm();
        }

        function submitForm() {
            document.getElementById('filter-form').submit();
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('[id$="-dropdown"]');
            const buttons = document.querySelectorAll('[onclick*="toggleDropdown"]');
            
            let isClickInsideDropdown = false;
            dropdowns.forEach(dropdown => {
                if (dropdown.contains(event.target)) {
                    isClickInsideDropdown = true;
                }
            });
            
            let isClickOnButton = false;
            buttons.forEach(button => {
                if (button.contains(event.target)) {
                    isClickOnButton = true;
                }
            });
            
            if (!isClickInsideDropdown && !isClickOnButton) {
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>
@endsection
