@extends('layouts.admin')

@section('title', 'แก้ไขบทความ')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">แก้ไขบทความ</h1>
            <div class="space-x-2">
                <a href="{{ route('admin.articles.show', $article) }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg">
                    ดูบทความ
                </a>
                <a href="{{ route('admin.articles.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg">
                    กลับ
                </a>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">พบข้อผิดพลาดในการกรอกข้อมูล:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white shadow-sm rounded-lg">
        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data"
            class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            หัวข้อบทความ <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                            value="{{ old('title', $article->title) }}" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-300 @enderror"
                            placeholder="กรอกหัวข้อบทความ">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content with Quill Editor -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            เนื้อหาบทความ <span class="text-red-500">*</span>
                        </label>
                        <div id="content-editor" style="height: 300px;"></div>
                        <input type="hidden" name="content" id="content"
                            value="{{ old('content', $article->content) }}">
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                            เนื้อหาย่อ
                            <span class="text-gray-500 text-xs">(ถ้าไม่กรอก จะสร้างอัตโนมัติจากเนื้อหา)</span>
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-300 @enderror"
                            placeholder="กรอกเนื้อหาย่อสำหรับแสดงในรายการ">{{ old('excerpt', $article->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                            คำอธิบายสำหรับ SEO
                        </label>
                        <textarea name="meta_description" id="meta_description" rows="2"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_description') border-red-300 @enderror"
                            placeholder="คำอธิบายสำหรับ Search Engine (แนะนำ 150-160 ตัวอักษร)">{{ old('meta_description', $article->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column - Settings -->
                <div class="space-y-6">
                    <!-- Current Image -->
                    @if ($article->image)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                รูปภาพปัจจุบัน
                            </label>
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                class="w-full h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $article->image ? 'เปลี่ยนรูปภาพ' : 'รูปภาพประกอบ' }}
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>อัพโหลดรูปภาพ</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">หรือลากไฟล์มาวาง</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF ขนาดไม่เกิน 2MB</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            หมวดหมู่
                        </label>
                        <select name="category" id="category"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-300 @enderror">
                            <option value="">เลือกหมวดหมู่</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" @selected(old('category', $article->category) == $category)>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                            ผู้เขียน
                        </label>
                        <input type="text" name="author" id="author"
                            value="{{ old('author', $article->author) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('author') border-red-300 @enderror"
                            placeholder="ชื่อผู้เขียน">
                        @error('author')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Published Date -->
                    <div>
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                            วันที่เผยแพร่
                        </label>
                        <input type="datetime-local" name="published_at" id="published_at"
                            value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('published_at') border-red-300 @enderror">
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                            ลำดับการแสดงผล <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="sort_order" id="sort_order"
                            value="{{ old('sort_order', $article->sort_order) }}" min="1" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sort_order') border-red-300 @enderror">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Published Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            สถานะ
                        </label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_published" value="1"
                                    @checked(old('is_published', $article->is_published ? '1' : '0') == '1')
                                    class="border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">เผยแพร่ทันที</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_published" value="0"
                                    @checked(old('is_published', $article->is_published ? '1' : '0') == '0')
                                    class="border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">บันทึกเป็นร่าง</span>
                            </label>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">สถิติ</h3>
                        <div class="space-y-1 text-sm text-gray-600">
                            <div>การอ่าน: {{ number_format($article->views_count) }} ครั้ง</div>
                            @if ($article->reading_time)
                                <div>เวลาอ่าน: {{ $article->reading_time }} นาที</div>
                            @endif
                            <div>สร้างเมื่อ: {{ $article->created_at->format('d/m/Y H:i') }}</div>
                            <div>แก้ไขล่าสุด: {{ $article->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.articles.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    บันทึกการแก้ไข
                </button>
            </div>
        </form>
    </div>

    <!-- Include Quill.js -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // Initialize Quill editor
        const quill = new Quill('#content-editor', {
            theme: 'snow',
            placeholder: 'เขียนเนื้อหาบทความ...',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'align': []
                    }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        // Set initial content
        quill.root.innerHTML = {!! json_encode(old('content', $article->content)) !!};

        // Update hidden input when form is submitted
        document.querySelector('form').addEventListener('submit', function(e) {
            const content = quill.root.innerHTML;
            document.querySelector('#content').value = content;
            
            // Check if content is empty (only contains empty tags)
            const textContent = quill.getText().trim();
            if (textContent.length === 0) {
                e.preventDefault();
                alert('กรุณากรอกเนื้อหาบทความ');
                return false;
            }
        });

        // Also update on content change
        quill.on('text-change', function() {
            document.querySelector('#content').value = quill.root.innerHTML;
        });

        // Image upload preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const uploadDiv = e.target.closest('.border-dashed');
            
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('ขนาดไฟล์ใหญ่เกินไป กรุณาเลือกไฟล์ที่มีขนาดไม่เกิน 2MB');
                    e.target.value = '';
                    return;
                }
                
                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้น');
                    e.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview
                    const existingPreview = uploadDiv.querySelector('.image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Create new preview
                    const preview = document.createElement('div');
                    preview.className = 'image-preview mt-4';
                    preview.innerHTML = `
                        <img src="${e.target.result}" class="h-32 w-auto rounded-lg object-cover mx-auto">
                        <p class="text-sm text-gray-600 text-center mt-2">${file.name}</p>
                    `;
                    
                    uploadDiv.appendChild(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection