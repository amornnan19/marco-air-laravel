@extends('layouts.admin')

@section('title', 'แก้ไขบริการ: ' . $service->name)

@section('content')
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">แก้ไขบริการ: {{ $service->name }}</h1>
            <p class="mt-1 text-sm text-gray-600">แก้ไขข้อมูลบริการ</p>
        </div>

        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">ข้อมูลพื้นฐาน</h2>

                <!-- Service Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">ชื่อบริการ <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug) }}"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <p class="mt-1 text-sm text-gray-500">ปล่อยว่างเพื่อให้ระบบสร้างอัตโนมัติ</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">คำอธิบาย <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="4"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Hero Image -->
                @if ($service->hero_image_url)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">รูปภาพปัจจุบัน</label>
                        <img src="{{ $service->hero_image_url }}" alt="{{ $service->name }}"
                            class="h-32 w-auto rounded-lg object-cover">
                    </div>
                @endif

                <!-- Hero Image -->
                <div class="mb-6">
                    <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">รูปภาพหลัก</label>
                    <input type="file" name="hero_image" id="hero_image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="mt-1 text-sm text-gray-500">เลือกไฟล์ใหม่เพื่อเปลี่ยนรูปภาพ</p>
                    @error('hero_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon Color -->
                <div class="mb-6">
                    <label for="icon_color" class="block text-sm font-medium text-gray-700 mb-2">สีไอคอน <span
                            class="text-red-500">*</span></label>
                    <select name="icon_color" id="icon_color"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                        <option value="">เลือกสี</option>
                        <option value="blue" {{ old('icon_color', $service->icon_color) === 'blue' ? 'selected' : '' }}>
                            น้ำเงิน</option>
                        <option value="green" {{ old('icon_color', $service->icon_color) === 'green' ? 'selected' : '' }}>
                            เขียว</option>
                        <option value="orange" {{ old('icon_color', $service->icon_color) === 'orange' ? 'selected' : '' }}>
                            ส้ม</option>
                        <option value="red" {{ old('icon_color', $service->icon_color) === 'red' ? 'selected' : '' }}>แดง
                        </option>
                        <option value="purple" {{ old('icon_color', $service->icon_color) === 'purple' ? 'selected' : '' }}>
                            ม่วง</option>
                        <option value="yellow" {{ old('icon_color', $service->icon_color) === 'yellow' ? 'selected' : '' }}>
                            เหลือง</option>
                    </select>
                    @error('icon_color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Phone -->
                <div class="mb-6">
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">เบอร์ติดต่อ</label>
                    <input type="text" name="contact_phone" id="contact_phone"
                        value="{{ old('contact_phone', $service->contact_phone) }}"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('contact_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Display -->
                <div class="mb-6">
                    <label for="price_display" class="block text-sm font-medium text-gray-700 mb-2">ราคาแสดง</label>
                    <input type="number" name="price_display" id="price_display"
                        value="{{ old('price_display', $service->price_display) }}" step="0.01" min="0"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('price_display')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Settings -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">เปิดใช้งาน</span>
                        </label>
                    </div>
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">ลำดับการแสดง</label>
                        <input type="number" name="sort_order" id="sort_order"
                            value="{{ old('sort_order', $service->sort_order) }}"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
            </div>

            <!-- Service Packages -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">แพ็กเกจบริการ</h2>
                <div id="packages-container">
                    @foreach ($service->packages ?? [] as $index => $package)
                        <div class="package-item border rounded-lg p-4 mb-4" data-index="{{ $index }}">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-md font-medium text-gray-900">แพ็กเกจ {{ $index + 1 }}</h3>
                                <button type="button" onclick="removePackage({{ $index }})"
                                    class="text-red-600 hover:text-red-800 text-sm {{ $index === 0 ? 'hidden' : '' }}">ลบ</button>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อแพ็กเกจ <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="packages[{{ $index }}][name]"
                                        value="{{ old("packages.{$index}.name", $package['name'] ?? '') }}"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ราคา <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="packages[{{ $index }}][price]"
                                        value="{{ old("packages.{$index}.price", $package['price'] ?? '') }}"
                                        step="0.01" min="0"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">หน่วย <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="packages[{{ $index }}][unit]"
                                        value="{{ old("packages.{$index}.unit", $package['unit'] ?? '') }}"
                                        placeholder="เช่น ครั้ง, เดือน, ปี"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">รายละเอียด <span
                                            class="text-red-500">*</span></label>
                                    <textarea name="packages[{{ $index }}][description]" rows="3"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>{{ old("packages.{$index}.description", $package['description'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addPackage()"
                    class="mt-4 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg">
                    เพิ่มแพ็กเกจ
                </button>
            </div>

            <!-- Service Details -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">รายละเอียดบริการ</h2>
                <div id="details-container">
                    @foreach ($service->details ?? [] as $index => $detail)
                        <div class="detail-item flex items-center gap-4 mb-4" data-index="{{ $index }}">
                            <input type="text" name="details[{{ $index }}]"
                                value="{{ old("details.{$index}", $detail) }}" placeholder="รายละเอียดบริการ"
                                class="flex-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <button type="button" onclick="removeDetail({{ $index }})"
                                class="text-red-600 hover:text-red-800 text-sm {{ $index === 0 ? 'hidden' : '' }}">ลบ</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addDetail()"
                    class="mt-4 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg">
                    เพิ่มรายละเอียด
                </button>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.services.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    อัปเดตบริการ
                </button>
            </div>
        </form>
    </div>

    <script>
        let packageIndex = {{ count($service->packages ?? []) }};
        let detailIndex = {{ count($service->details ?? []) }};

        function addPackage() {
            const container = document.getElementById('packages-container');
            const newPackage = `
                <div class="package-item border rounded-lg p-4 mb-4" data-index="${packageIndex}">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-md font-medium text-gray-900">แพ็กเกจ ${packageIndex + 1}</h3>
                        <button type="button" onclick="removePackage(${packageIndex})" class="text-red-600 hover:text-red-800 text-sm">ลบ</button>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อแพ็กเกจ <span class="text-red-500">*</span></label>
                            <input type="text" name="packages[${packageIndex}][name]" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ราคา <span class="text-red-500">*</span></label>
                            <input type="number" name="packages[${packageIndex}][price]" step="0.01" min="0" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">หน่วย <span class="text-red-500">*</span></label>
                            <input type="text" name="packages[${packageIndex}][unit]" placeholder="เช่น ครั้ง, เดือน, ปี" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">รายละเอียด <span class="text-red-500">*</span></label>
                            <textarea name="packages[${packageIndex}][description]" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newPackage);
            packageIndex++;
            updatePackageRemoveButtons();
        }

        function removePackage(index) {
            const packageItem = document.querySelector(`[data-index="${index}"]`);
            if (packageItem) {
                packageItem.remove();
                updatePackageRemoveButtons();
            }
        }

        function updatePackageRemoveButtons() {
            const packages = document.querySelectorAll('.package-item');
            packages.forEach((pkg, index) => {
                const removeBtn = pkg.querySelector('button[onclick*="removePackage"]');
                if (packages.length > 1) {
                    removeBtn.classList.remove('hidden');
                } else {
                    removeBtn.classList.add('hidden');
                }
            });
        }

        function addDetail() {
            const container = document.getElementById('details-container');
            const newDetail = `
                <div class="detail-item flex items-center gap-4 mb-4" data-index="${detailIndex}">
                    <input type="text" name="details[${detailIndex}]" placeholder="รายละเอียดบริการ" class="flex-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="button" onclick="removeDetail(${detailIndex})" class="text-red-600 hover:text-red-800 text-sm">ลบ</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newDetail);
            detailIndex++;
            updateDetailRemoveButtons();
        }

        function removeDetail(index) {
            const detailItem = document.querySelector(`.detail-item[data-index="${index}"]`);
            if (detailItem) {
                detailItem.remove();
                updateDetailRemoveButtons();
            }
        }

        function updateDetailRemoveButtons() {
            const details = document.querySelectorAll('.detail-item');
            details.forEach((detail, index) => {
                const removeBtn = detail.querySelector('button[onclick*="removeDetail"]');
                if (details.length > 1) {
                    removeBtn.classList.remove('hidden');
                } else {
                    removeBtn.classList.add('hidden');
                }
            });
        }

        // Auto-generate slug from name
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special characters
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
                .trim();
            
            document.getElementById('slug').value = slug;
        });

        // Initialize remove button visibility
        updatePackageRemoveButtons();
        updateDetailRemoveButtons();
    </script>
@endsection