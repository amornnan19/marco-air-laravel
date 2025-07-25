@extends('layouts.admin')

@section('title', 'แก้ไขโปรโมชัน - Admin Panel')

@section('content')
    <div class="px-4 py-6 sm:px-0">
        <!-- Page Header -->
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('admin.promotions.index') }}" class="text-gray-500 hover:text-gray-700">โปรโมชัน</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-500 ml-1 md:ml-2">แก้ไข: {{ $promotion->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-gray-900">แก้ไขโปรโมชัน</h2>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg">
            <form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">ชื่อโปรโมชัน *</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $promotion->title) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">เนื้อหาโปรโมชัน *</label>
                    <div id="quill-editor" style="min-height: 200px;" class="bg-white border border-gray-300 rounded-md"></div>
                    <textarea name="content" 
                              id="content" 
                              class="hidden"
                              required>{{ old('content', $promotion->content) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">อธิบายรายละเอียดโปรโมชัน (รองรับ Rich Text)</p>
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">รูปภาพโปรโมชัน</label>
                    
                    <!-- Current Image -->
                    @if($promotion->image)
                        <div id="current-image" class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">รูปภาพปัจจุบัน:</p>
                            <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}" class="max-w-xs h-auto rounded-lg shadow-md">
                            <button type="button" onclick="removeCurrentImage()" class="mt-2 text-sm text-red-600 hover:text-red-800">ลบรูปภาพปัจจุบัน</button>
                        </div>
                    @endif
                    
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>{{ $promotion->image ? 'เปลี่ยนรูปภาพ' : 'อัพโหลดรูปภาพ' }}</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">หรือลากไฟล์มาวาง</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF สูงสุด 2MB</p>
                        </div>
                    </div>
                    <!-- New Image Preview -->
                    <div id="image-preview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">รูปภาพใหม่:</p>
                        <img id="preview-img" src="" alt="Preview" class="max-w-xs h-auto rounded-lg shadow-md">
                        <button type="button" onclick="removeImage()" class="mt-2 text-sm text-red-600 hover:text-red-800">ยกเลิกรูปภาพใหม่</button>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link URL & Button Text -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="link_url" class="block text-sm font-medium text-gray-700">ลิงก์ปุ่ม</label>
                        <input type="url" 
                               name="link_url" 
                               id="link_url" 
                               value="{{ old('link_url', $promotion->link_url) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               placeholder="https://example.com">
                    </div>
                    <div>
                        <label for="button_text" class="block text-sm font-medium text-gray-700">ข้อความปุ่ม *</label>
                        <input type="text" 
                               name="button_text" 
                               id="button_text" 
                               value="{{ old('button_text', $promotion->button_text) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">วันที่เริ่มต้น</label>
                        <input type="datetime-local" 
                               name="start_date" 
                               id="start_date" 
                               value="{{ old('start_date', $promotion->start_date?->format('Y-m-d\TH:i')) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">วันที่สิ้นสุด</label>
                        <input type="datetime-local" 
                               name="end_date" 
                               id="end_date" 
                               value="{{ old('end_date', $promotion->end_date?->format('Y-m-d\TH:i')) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Sort Order & Active -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700">ลำดับการแสดง *</label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               value="{{ old('sort_order', $promotion->sort_order) }}"
                               min="0"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <p class="mt-1 text-sm text-gray-500">เลขน้อยแสดงก่อน</p>
                    </div>
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700">สถานะ</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       value="1"
                                       {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">เปิดใช้งาน</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.promotions.index') }}" 
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        ยกเลิก
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        บันทึกการแก้ไข
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize Quill editor
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'blockquote'],
                    ['clean']
                ]
            },
            placeholder: 'เขียนเนื้อหาโปรโมชัน...'
        });

        // Sync Quill content with hidden textarea
        var contentTextarea = document.getElementById('content');
        
        // Set initial content if exists
        if (contentTextarea.value) {
            quill.root.innerHTML = contentTextarea.value;
        }
        
        // Update textarea when Quill content changes
        quill.on('text-change', function() {
            contentTextarea.value = quill.root.innerHTML;
        });

        // Ensure textarea is updated before form submission
        document.querySelector('form').addEventListener('submit', function() {
            contentTextarea.value = quill.root.innerHTML;
        });

        // Image upload functions
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('image-preview').classList.add('hidden');
            document.getElementById('preview-img').src = '';
        }

        function removeCurrentImage() {
            if (confirm('ต้องการลบรูปภาพปัจจุบันหรือไม่?')) {
                document.getElementById('current-image').style.display = 'none';
                // Create hidden input to mark image for deletion
                var deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_image';
                deleteInput.value = '1';
                document.querySelector('form').appendChild(deleteInput);
            }
        }
    </script>
@endsection