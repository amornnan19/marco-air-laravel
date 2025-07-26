@extends('layouts.app')

@section('title', 'สั่งบริการ' . $service->name . ' - Marco Air')

@section('head')
    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
            <div class="flex items-center gap-3">
                <button onclick="history.back()" class="p-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h1 class="font-bold text-lg">สั่งบริการ</h1>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white border-b border-gray-200">
            <div class="flex">
                <button class="tab-btn flex-1 px-3 py-3 text-sm font-medium text-center border-b-2 border-blue-600 text-blue-600"
                    data-tab="order-details">
                    รายการสั่งซื้อ
                </button>
                <button class="tab-btn flex-1 px-3 py-3 text-sm font-medium text-center border-b-2 border-transparent text-gray-500"
                    data-tab="location">
                    สถานที่
                </button>
                <button class="tab-btn flex-1 px-3 py-3 text-sm font-medium text-center border-b-2 border-transparent text-gray-500"
                    data-tab="schedule">
                    การยืนยัน
                </button>
                <button class="tab-btn flex-1 px-3 py-3 text-sm font-medium text-center border-b-2 border-transparent text-gray-500"
                    data-tab="payment">
                    ชำระเงิน
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-gray-50">
            <!-- Tab 1: Order Details -->
            <div id="order-details" class="tab-content p-4">
                <!-- Service Header -->
                <div class="bg-white rounded-lg p-4 mb-4 flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h4a1 1 0 011 1v5m-6 0V9a1 1 0 011-1h4a1 1 0 011 1v11">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-blue-600">{{ $service->name }}</h2>
                    </div>
                </div>

                <!-- Air Conditioner Items -->
                <div id="ac-items-container" class="space-y-4">
                    <!-- Default Item -->
                    <div class="ac-item bg-white rounded-lg p-4" data-index="0">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-semibold text-gray-900">เครื่องปรับอากาศที่ 1</h3>
                            <button type="button" onclick="removeAcItem(0)" class="text-red-600 hover:text-red-800 text-sm hidden">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <!-- Brand Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ยี่ห้อแอร์ <span class="text-red-500">*</span></label>
                                <select name="ac_items[0][brand]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">เลือกยี่ห้อ</option>
                                    <option value="Mitsubishi">Mitsubishi</option>
                                    <option value="Panasonic">Panasonic</option>
                                    <option value="Daikin">Daikin</option>
                                    <option value="Samsung">Samsung</option>
                                    <option value="LG">LG</option>
                                    <option value="Toshiba">Toshiba</option>
                                    <option value="Carrier">Carrier</option>
                                    <option value="York">York</option>
                                    <option value="Fujitsu">Fujitsu</option>
                                    <option value="Hitachi">Hitachi</option>
                                    <option value="Gree">Gree</option>
                                    <option value="Haier">Haier</option>
                                    <option value="TCL">TCL</option>
                                    <option value="Sharp">Sharp</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                            </div>

                            <!-- BTU Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ขนาด BTU <span class="text-red-500">*</span></label>
                                <select name="ac_items[0][btu]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" onchange="updateAllPrices()" required>
                                    <option value="">เลือกขนาด BTU</option>
                                    <option value="9000">9,000 BTU</option>
                                    <option value="12000">12,000 BTU</option>
                                    <option value="15000">15,000 BTU</option>
                                    <option value="18000">18,000 BTU</option>
                                    <option value="21000">21,000 BTU</option>
                                    <option value="24000">24,000 BTU</option>
                                    <option value="30000">30,000 BTU</option>
                                    <option value="36000">36,000 BTU</option>
                                    <option value="48000">48,000 BTU</option>
                                    <option value="60000">60,000 BTU</option>
                                </select>
                            </div>


                            <!-- Quantity Selector -->
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">จำนวน (เครื่อง)</span>
                                <div class="flex items-center gap-3">
                                    <button type="button" onclick="changeQuantity(0, -1)" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="text-lg font-medium quantity-display" data-index="0">1</span>
                                    <input type="hidden" name="ac_items[0][quantity]" value="1" class="quantity-input">
                                    <button type="button" onclick="changeQuantity(0, 1)" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Add More Button -->
                <button type="button" onclick="addAcItem()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    เพิ่มเครื่องปรับอากาศ
                </button>

                <!-- Pricing Info -->
                <div class="bg-blue-50 rounded-lg p-4 mt-6">
                    <h3 class="font-semibold text-gray-900 mb-3">โปรโมชั่นราคาพิเศษ</h3>
                    <div class="space-y-2 text-sm text-gray-700">
                        <div class="flex justify-between">
                            <span>ล้าง 1 เครื่อง</span>
                            <span class="font-medium">650 บาท/เครื่อง</span>
                        </div>
                        <div class="flex justify-between">
                            <span>ล้าง 2 เครื่อง</span>
                            <span class="font-medium">550 บาท/เครื่อง</span>
                        </div>
                        <div class="flex justify-between">
                            <span>ล้าง 3 เครื่อง</span>
                            <span class="font-medium">500 บาท/เครื่อง</span>
                        </div>
                        <div class="flex justify-between">
                            <span>ล้าง 4+ เครื่อง</span>
                            <span class="font-medium">450 บาท/เครื่อง</span>
                        </div>
                    </div>
                    <div class="border-t border-blue-200 mt-3 pt-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">จำนวนเครื่องทั้งหมด: <span id="total-units">0</span> เครื่อง</span>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-lg font-semibold text-gray-900">ราคารวมทั้งหมด</span>
                            <span class="text-2xl font-bold text-blue-600" id="grand-total">0 บาท</span>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">*ทุก BTU จบในราคาเดียว ไม่มีค่าใช้จ่ายเพิ่มเติม</p>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Location -->
            <div id="location" class="tab-content hidden p-4">
                <form class="space-y-6">
                    <!-- Customer Information -->
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-900">ข้อมูลของคุณ</h3>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2 rounded border-gray-300">
                                <span class="text-sm text-gray-600">ใช้ข้อมูลในโปรไฟล์ของคุณ</span>
                            </label>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อ <span class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">นามสกุล <span class="text-red-500">*</span></label>
                                <input type="text" name="customer_lastname" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">อีเมล</label>
                                <input type="email" name="customer_email" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">เบอร์โทรศัพท์ <span class="text-red-500">*</span></label>
                                <input type="tel" name="customer_phone" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">หมายเลขโครงการที่</label>
                                <input type="text" name="project_number" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                        </div>
                    </div>

                    <!-- Service Location -->
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-900">ที่อยู่ของคุณ</h3>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2 rounded border-gray-300">
                                <span class="text-sm text-gray-600">ใช้ข้อมูลในโปรไฟล์ของคุณ</span>
                            </label>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">จังหวัด <span class="text-red-500">*</span></label>
                                <input type="text" name="province" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">เขต/อำเภอ <span class="text-red-500">*</span></label>
                                <input type="text" name="district" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">แขวง/ตำบล <span class="text-red-500">*</span></label>
                                <input type="text" name="subdistrict" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">รหัสไปรษณีย์ <span class="text-red-500">*</span></label>
                                <input type="text" name="postal_code" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">บ้านเลขที่ <span class="text-red-500">*</span></label>
                                <input type="text" name="house_number" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">หมู่ที่</label>
                                <input type="text" name="village_number" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อหมู่บ้าน/อาคาร</label>
                            <input type="text" name="building_name" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ซอย</label>
                                <input type="text" name="soi" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ถนน</label>
                                <input type="text" name="road" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">รายละเอียดเพิ่มเติม (ถ้ามี)</label>
                            <textarea name="address_note" class="w-full border border-gray-300 rounded-md px-3 py-2 h-20"></textarea>
                        </div>
                    </div>

                    <!-- Appointment Scheduling -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">การนัดหมาย</h3>

                        <div class="space-y-4">
                            <!-- Date Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">เลือกวันที่ <span class="text-red-500">*</span></label>
                                <input type="date" name="appointment_date" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <!-- Time Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">เลือกช่วงเวลา <span class="text-red-500">*</span></label>
                                <select name="appointment_time" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">เลือกช่วงเวลา</option>
                                    <option value="08:00-12:00">08:00 - 12:00 น. (เช้า)</option>
                                    <option value="13:00-17:00">13:00 - 17:00 น. (บ่าย)</option>
                                    <option value="18:00-20:00">18:00 - 20:00 น. (เย็น)</option>
                                </select>
                            </div>

                            <!-- Notes to Technician -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">หมายเหตุถึงทีมช่าง</label>
                                <textarea name="technician_notes" rows="4" placeholder="ระบุข้อมูลเพิ่มเติม เช่น ที่จอดรถ, ทางเข้าอาคาร, เวลาที่สะดวก, ข้อควรระวัง..."
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                        </div>

                        <!-- Important Notice -->
                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-medium text-yellow-800">ข้อมูลสำคัญ</p>
                                    <p class="text-yellow-700 mt-1">• ทีมช่างจะติดต่อกลับเพื่อยืนยันการนัดหมายก่อนเดินทาง</p>
                                    <p class="text-yellow-700">• สามารถเปลี่ยนแปลงนัดหมายได้โดยติดต่อ Call Center</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">ตัวเลือกเพิ่มเติม</h3>
                        
                        <div class="space-y-4">
                            <!-- Tax Invoice Request -->
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" name="request_tax_invoice" id="request_tax_invoice" 
                                    class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <label for="request_tax_invoice" class="text-sm text-gray-700">
                                    <span class="font-medium">ต้องการใบกำกับภาษี</span>
                                    <p class="text-gray-600 mt-1">หากต้องการใบกำกับภาษี กรุณาติ๊กถูกและระบุข้อมูลบริษัทในหมายเหตุ</p>
                                </label>
                            </div>

                            <!-- Terms and Privacy Policy -->
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" name="accept_terms" id="accept_terms" 
                                    class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                <label for="accept_terms" class="text-sm text-gray-700">
                                    <span class="font-medium">ยอมรับข้อกำหนดและเงื่อนไข <span class="text-red-500">*</span></span>
                                    <p class="text-gray-600 mt-1">
                                        ข้าพเจ้ายอมรับ
                                        <a href="{{ route('terms.conditions') }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">ข้อกำหนดและเงื่อนไข</a>
                                        และ
                                        <a href="{{ route('privacy.policy') }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">นโยบายความเป็นส่วนตัว</a>
                                        ของบริษัท
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tab 3: Schedule -->
            <div id="schedule" class="tab-content hidden p-4">
                <div class="space-y-6">
                    <!-- Contact Information -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">ข้อมูลการติดต่อ</h3>
                        
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">ชื่อ-นามสกุล</span>
                                <span class="text-gray-900">ศักดา ทุนดิษ</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">หมายเลขโครงการที่</span>
                                <span class="text-gray-900">056 567 7890</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">อีเมล</span>
                                <span class="text-gray-900">ccc2@yahoo.com</span>
                            </div>
                        </div>
                    </div>

                    <!-- Service Information -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">ที่อยู่ในลงห์ของบริการ</h3>
                        <p class="text-sm text-gray-600">64 ถนน ริมา มีเอี้ย ตำบล มานแหลนี้ย อำเภอมีไผปุ่ด นนทบุรี 11000</p>
                    </div>

                    <!-- Appointment Schedule -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">วันและเวลานัดบริการ</h3>
                        
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm text-gray-900">เสาร์ที่ 16 ธ.ค. 2566</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-900">13:00-17:00 น.</span>
                        </div>
                    </div>

                    <!-- Special Instructions -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">หมายเหตุดิงก์ทันนั่วร้าง</h3>
                        <p class="text-sm text-gray-600">ใต้งเซ่งดูองเซแป่น 20 บาท</p>
                    </div>

                    <!-- Service Summary -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">รายการสนค่าเรือการบริการ</h3>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h4a1 1 0 011 1v5m-6 0V9a1 1 0 011-1h4a1 1 0 011 1v11">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">ตรวจสอบ/ซ่อมแอร์</h4>
                                <p class="text-sm text-gray-600">panasonic / BTU12,000</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-600">650 บาท</p>
                                <p class="text-xs text-gray-500">(ไม่รวม)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 4: Payment -->
            <div id="payment" class="tab-content hidden p-4">
                <div class="space-y-6">
                    <!-- Order Summary -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">สรุปคำสั่งซื้อ</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">บริการ</span>
                                <span class="text-gray-900">{{ $service->name }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">จำนวนเครื่อง</span>
                                <span class="text-gray-900" id="payment-total-units">0 เครื่อง</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">ยอดรวมทั้งหมด</span>
                                    <span class="text-xl font-bold text-blue-600" id="payment-grand-total">0 บาท</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stripe Payment Form -->
                    <div class="bg-white rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">ชำระเงินด้วยบัตรเครดิต/เดบิต</h3>
                        
                        <!-- Stripe Card Element Container -->
                        <form id="payment-form">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">ข้อมูลบัตร</label>
                                <div id="card-element" class="p-3 border border-gray-300 rounded-md bg-white">
                                    <!-- Stripe Elements will create form elements here -->
                                </div>
                                <div id="card-errors" role="alert" class="text-red-600 text-sm mt-2"></div>
                            </div>

                            <!-- Cardholder Name -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อผู้ถือบัตร</label>
                                <input type="text" id="cardholder-name" placeholder="ชื่อตามที่ปรากฏบนบัตร"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <!-- Billing Address (if needed) -->
                            <div class="mb-6">
                                <label class="flex items-center">
                                    <input type="checkbox" id="same-as-service-address" checked
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">ใช้ที่อยู่เดียวกับที่อยู่บริการ</span>
                                </label>
                            </div>

                            <!-- Security Information -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">การชำระเงินปลอดภัย</p>
                                        <p class="text-gray-600 mt-1">ข้อมูลบัตรของคุณได้รับการเข้ารหัสและปกป้องด้วย Stripe SSL</p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="text-xs text-gray-500">รองรับ:</span>
                                            <div class="flex gap-1">
                                                <div class="w-8 h-5 bg-blue-600 rounded text-white text-xs flex items-center justify-center">VISA</div>
                                                <div class="w-8 h-5 bg-red-600 rounded text-white text-xs flex items-center justify-center">MC</div>
                                                <div class="w-8 h-5 bg-blue-800 rounded text-white text-xs flex items-center justify-center">AMEX</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Test Mode Information -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="text-sm">
                                        <p class="font-medium text-blue-900">🧪 โหมดทดสอบ</p>
                                        <p class="text-blue-800 mt-1">สำหรับการทดสอบ ใช้บัตรทดสอบ Stripe:</p>
                                        <div class="mt-2 space-y-1 text-xs text-blue-700">
                                            <p>• <strong>VISA:</strong> 4242 4242 4242 4242</p>
                                            <p>• <strong>Mastercard:</strong> 5555 5555 5555 4444</p>
                                            <p>• <strong>AMEX:</strong> 3782 822463 10005</p>
                                            <p>• <strong>วันหมดอายุ:</strong> อนาคต (เช่น 12/28)</p>
                                            <p>• <strong>CVC:</strong> รหัส 3-4 หลักใดก็ได้</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Processing Notice -->
                            <div id="payment-processing" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <div class="flex items-center">
                                    <svg class="animate-spin w-5 h-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="text-blue-800 font-medium">กำลังดำเนินการชำระเงิน...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- Bottom Action Bar -->
        <div class="bg-white border-t p-4">
            <div class="flex gap-3">
                <button id="prev-btn" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-3 px-4 rounded-lg hidden">
                    ยกเลิก
                </button>
                <button id="next-btn" class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-4 rounded-lg">
                    ถัดไป
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentTab = 0;
        let acItemIndex = 1;
        const tabs = ['order-details', 'location', 'schedule', 'payment'];
        const tabLabels = ['รายการสั่งซื้อ', 'สถานที่', 'การยืนยัน', 'ชำระเงิน'];
        const servicePackages = @json($service->packages);

        function showTab(index) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show current tab content
            document.getElementById(tabs[index]).classList.remove('hidden');

            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach((btn, i) => {
                if (i === index) {
                    btn.classList.add('border-blue-600', 'text-blue-600');
                    btn.classList.remove('border-transparent', 'text-gray-500');
                } else {
                    btn.classList.remove('border-blue-600', 'text-blue-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                }
            });

            // Update buttons
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            if (index === 0) {
                prevBtn.classList.add('hidden');
                nextBtn.textContent = 'ถัดไป';
                nextBtn.className = 'flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-4 rounded-lg';
            } else if (index === tabs.length - 1) {
                prevBtn.classList.remove('hidden');
                prevBtn.textContent = 'ยกเลิก';
                updatePaymentButtonText();
                nextBtn.className = 'flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-4 rounded-lg';
            } else {
                prevBtn.classList.remove('hidden');
                prevBtn.textContent = 'ยกเลิก';
                nextBtn.textContent = 'ถัดไป';
                nextBtn.className = 'flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-4 rounded-lg';
            }

            currentTab = index;
        }

        // AC Items Management
        function addAcItem() {
            const container = document.getElementById('ac-items-container');

            const newItem = `
                <div class="ac-item bg-white rounded-lg p-4" data-index="${acItemIndex}">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold text-gray-900">เครื่องปรับอากาศที่ ${acItemIndex + 1}</h3>
                        <button type="button" onclick="removeAcItem(${acItemIndex})" class="text-red-600 hover:text-red-800 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ยี่ห้อแอร์ <span class="text-red-500">*</span></label>
                            <select name="ac_items[${acItemIndex}][brand]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">เลือกยี่ห้อ</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Panasonic">Panasonic</option>
                                <option value="Daikin">Daikin</option>
                                <option value="Samsung">Samsung</option>
                                <option value="LG">LG</option>
                                <option value="Toshiba">Toshiba</option>
                                <option value="Carrier">Carrier</option>
                                <option value="York">York</option>
                                <option value="Fujitsu">Fujitsu</option>
                                <option value="Hitachi">Hitachi</option>
                                <option value="Gree">Gree</option>
                                <option value="Haier">Haier</option>
                                <option value="TCL">TCL</option>
                                <option value="Sharp">Sharp</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ขนาด BTU <span class="text-red-500">*</span></label>
                            <select name="ac_items[${acItemIndex}][btu]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" onchange="updateAllPrices()" required>
                                <option value="">เลือกขนาด BTU</option>
                                <option value="9000">9,000 BTU</option>
                                <option value="12000">12,000 BTU</option>
                                <option value="15000">15,000 BTU</option>
                                <option value="18000">18,000 BTU</option>
                                <option value="21000">21,000 BTU</option>
                                <option value="24000">24,000 BTU</option>
                                <option value="30000">30,000 BTU</option>
                                <option value="36000">36,000 BTU</option>
                                <option value="48000">48,000 BTU</option>
                                <option value="60000">60,000 BTU</option>
                            </select>
                        </div>


                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-700">จำนวน (เครื่อง)</span>
                            <div class="flex items-center gap-3">
                                <button type="button" onclick="changeQuantity(${acItemIndex}, -1)" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span class="text-lg font-medium quantity-display" data-index="${acItemIndex}">1</span>
                                <input type="hidden" name="ac_items[${acItemIndex}][quantity]" value="1" class="quantity-input">
                                <button type="button" onclick="changeQuantity(${acItemIndex}, 1)" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', newItem);
            acItemIndex++;
            updateRemoveButtons();
            updateAllPrices();
        }

        function removeAcItem(index) {
            const item = document.querySelector(`[data-index="${index}"]`);
            if (item) {
                item.remove();
                updateRemoveButtons();
                updateAllPrices();
            }
        }

        function updateRemoveButtons() {
            const items = document.querySelectorAll('.ac-item');
            items.forEach((item, index) => {
                const removeBtn = item.querySelector('button[onclick*="removeAcItem"]');
                if (items.length > 1) {
                    removeBtn.classList.remove('hidden');
                } else {
                    removeBtn.classList.add('hidden');
                }
            });
        }

        function changeQuantity(index, change) {
            const display = document.querySelector(`[data-index="${index}"].quantity-display`);
            const input = document.querySelector(`[name="ac_items[${index}][quantity]"]`);
            
            let quantity = parseInt(input.value) + change;
            if (quantity < 1) quantity = 1;
            
            display.textContent = quantity;
            input.value = quantity;
            
            updateAllPrices();
        }

        function updateAllPrices() {
            // Calculate total units across all items
            let totalUnits = 0;
            document.querySelectorAll('.quantity-input').forEach(input => {
                totalUnits += parseInt(input.value) || 0;
            });

            // Determine price per unit based on total quantity
            let pricePerUnit = 0;
            if (totalUnits >= 4) {
                pricePerUnit = 450;
            } else if (totalUnits === 3) {
                pricePerUnit = 500;
            } else if (totalUnits === 2) {
                pricePerUnit = 550;
            } else if (totalUnits === 1) {
                pricePerUnit = 650;
            }


            // Update grand total
            const grandTotal = pricePerUnit * totalUnits;
            document.getElementById('grand-total').textContent = grandTotal.toLocaleString() + ' บาท';
            document.getElementById('total-units').textContent = totalUnits;
            
            // Update payment tab summary
            const paymentTotalUnits = document.getElementById('payment-total-units');
            const paymentGrandTotal = document.getElementById('payment-grand-total');
            
            if (paymentTotalUnits) {
                paymentTotalUnits.textContent = totalUnits + ' เครื่อง';
            }
            if (paymentGrandTotal) {
                paymentGrandTotal.textContent = grandTotal.toLocaleString() + ' บาท';
            }
            
            // Update payment button text
            updatePaymentButtonText();
        }

        // Update payment button text with current total
        function updatePaymentButtonText() {
            const nextBtn = document.getElementById('next-btn');
            if (nextBtn && currentTab === tabs.length - 1) {
                const totalUnits = parseInt(document.getElementById('total-units')?.textContent) || 0;
                let pricePerUnit = 0;
                if (totalUnits >= 4) {
                    pricePerUnit = 450;
                } else if (totalUnits === 3) {
                    pricePerUnit = 500;
                } else if (totalUnits === 2) {
                    pricePerUnit = 550;
                } else if (totalUnits === 1) {
                    pricePerUnit = 650;
                }
                const grandTotal = pricePerUnit * totalUnits;
                nextBtn.textContent = `ชำระเงิน ${grandTotal.toLocaleString()} บาท`;
            }
        }

        // Tab button click handlers
        document.querySelectorAll('.tab-btn').forEach((btn, index) => {
            btn.addEventListener('click', () => {
                // Only allow moving to next tabs if current and previous tabs are valid
                if (index <= currentTab) {
                    // Allow going back to previous tabs
                    showTab(index);
                } else {
                    // Check if all previous tabs are valid before allowing forward navigation
                    let canProceed = true;
                    for (let i = currentTab; i < index; i++) {
                        const tempCurrentTab = currentTab;
                        currentTab = i;
                        if (!validateCurrentTab()) {
                            canProceed = false;
                            currentTab = tempCurrentTab;
                            break;
                        }
                        currentTab = tempCurrentTab;
                    }
                    
                    if (canProceed) {
                        showTab(index);
                    }
                }
            });
        });

        // Validation functions
        function validateOrderDetails() {
            const items = document.querySelectorAll('.ac-item');
            if (items.length === 0) {
                alert('กรุณาเพิ่มเครื่องปรับอากาศอย่างน้อย 1 เครื่อง');
                return false;
            }

            for (let item of items) {
                const index = item.dataset.index;
                const brandSelect = document.querySelector(`[name="ac_items[${index}][brand]"]`);
                const btuSelect = document.querySelector(`[name="ac_items[${index}][btu]"]`);
                const quantityInput = document.querySelector(`[name="ac_items[${index}][quantity]"]`);

                if (!brandSelect.value) {
                    alert('กรุณาเลือกยี่ห้อแอร์ให้ครบถ้วน');
                    brandSelect.focus();
                    return false;
                }

                if (!btuSelect.value) {
                    alert('กรุณาเลือกขนาด BTU ให้ครบถ้วน');
                    btuSelect.focus();
                    return false;
                }

                if (!quantityInput.value || parseInt(quantityInput.value) < 1) {
                    alert('กรุณาระบุจำนวนเครื่องให้ถูกต้อง');
                    return false;
                }
            }

            const totalUnits = parseInt(document.getElementById('total-units').textContent);
            if (totalUnits === 0) {
                alert('กรุณาเลือกจำนวนเครื่องปรับอากาศ');
                return false;
            }

            return true;
        }

        function validateLocation() {
            const requiredFields = [
                { name: 'customer_name', label: 'ชื่อ' },
                { name: 'customer_lastname', label: 'นามสกุล' },
                { name: 'customer_phone', label: 'เบอร์โทรศัพท์' },
                { name: 'province', label: 'จังหวัด' },
                { name: 'district', label: 'เขต/อำเภอ' },
                { name: 'subdistrict', label: 'แขวง/ตำบล' },
                { name: 'postal_code', label: 'รหัสไปรษณีย์' },
                { name: 'house_number', label: 'บ้านเลขที่' },
                { name: 'appointment_date', label: 'วันที่นัดหมาย' },
                { name: 'appointment_time', label: 'เวลานัดหมาย' }
            ];

            for (let field of requiredFields) {
                const input = document.querySelector(`[name="${field.name}"]`);
                if (!input || !input.value.trim()) {
                    alert(`กรุณาเลือก${field.label}`);
                    if (input) input.focus();
                    return false;
                }
            }

            // Validate appointment date is not in the past
            const appointmentDate = document.querySelector('[name="appointment_date"]').value;
            if (appointmentDate) {
                const selectedDate = new Date(appointmentDate);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time to beginning of day
                
                if (selectedDate < today) {
                    alert('ไม่สามารถเลือกวันที่ในอดีตได้');
                    document.querySelector('[name="appointment_date"]').focus();
                    return false;
                }
            }

            // Validate terms acceptance
            const acceptTerms = document.querySelector('[name="accept_terms"]');
            if (!acceptTerms.checked) {
                alert('กรุณายอมรับข้อกำหนดและเงื่อนไข');
                acceptTerms.focus();
                return false;
            }

            return true;
        }

        function validateCurrentTab() {
            switch (currentTab) {
                case 0: // Order Details
                    return validateOrderDetails();
                case 1: // Location
                    return validateLocation();
                case 2: // Schedule
                    return true; // Skip validation for schedule tab
                case 3: // Payment
                    return true; // Payment validation will be handled separately
                default:
                    return true;
            }
        }

        // Navigation button handlers
        document.getElementById('next-btn').addEventListener('click', () => {
            if (currentTab < tabs.length - 1) {
                if (validateCurrentTab()) {
                    showTab(currentTab + 1);
                }
            } else {
                // Handle payment
                if (validateCurrentTab()) {
                    processPayment();
                }
            }
        });

        document.getElementById('prev-btn').addEventListener('click', () => {
            history.back();
        });

        // Payment method toggle
        function togglePaymentMethod(method) {
            console.log('Selected payment method:', method);
        }

        // Initialize Stripe
        let stripe, elements, cardElement;
        
        // Demo card form creation function
        function createDemoCardForm() {
            const cardElement = document.getElementById('card-element');
            if (!cardElement) return;
            
            cardElement.innerHTML = `
                <div class="space-y-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-blue-900 font-medium">🧪 โหมดทดสอบ - ใช้บัตรทดสอบ Stripe</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">หมายเลขบัตร</label>
                        <input type="text" id="demo-card-number" placeholder="หมายเลขบัตร" maxlength="23" 
                            class="w-full border border-gray-300 rounded-md px-3 py-3 text-lg focus:ring-blue-500 focus:border-blue-500 font-mono tracking-wider"
                            autocomplete="cc-number">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">วันหมดอายุ</label>
                            <input type="text" id="demo-expiry" placeholder="MM / YY" maxlength="7" 
                                class="w-full border border-gray-300 rounded-md px-3 py-3 text-lg focus:ring-blue-500 focus:border-blue-500 font-mono"
                                autocomplete="cc-exp">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CVC</label>
                            <input type="text" id="demo-cvc" placeholder="CVC" maxlength="4" 
                                class="w-full border border-gray-300 rounded-md px-3 py-3 text-lg focus:ring-blue-500 focus:border-blue-500 font-mono"
                                autocomplete="cc-csc">
                        </div>
                    </div>
                    
                    <div class="text-xs text-gray-600 bg-gray-50 p-3 rounded-lg">
                        <div class="font-medium text-gray-800 mb-2">💳 บัตรทดสอบที่ใช้งานได้:</div>
                        <div class="grid grid-cols-1 gap-1">
                            <div class="flex justify-between">
                                <span>VISA:</span>
                                <code class="text-blue-600">4242 4242 4242 4242</code>
                            </div>
                            <div class="flex justify-between">
                                <span>Mastercard:</span>
                                <code class="text-blue-600">5555 5555 5555 4444</code>
                            </div>
                            <div class="flex justify-between">
                                <span>AMEX:</span>
                                <code class="text-blue-600">3782 822463 10005</code>
                            </div>
                            <div class="mt-2 text-gray-600">
                                <strong>วันหมดอายุ:</strong> อนาคต (เช่น 12/28) • <strong>CVC:</strong> รหัส 3-4 หลักใดก็ได้
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Add event listeners after creating the form
            setTimeout(() => {
                const cardInput = document.getElementById('demo-card-number');
                const expiryInput = document.getElementById('demo-expiry');
                const cvcInput = document.getElementById('demo-cvc');
                
                if (cardInput) {
                    cardInput.addEventListener('input', function() {
                        formatCardNumber(this);
                    });
                }
                
                if (expiryInput) {
                    expiryInput.addEventListener('input', function() {
                        formatExpiry(this);
                    });
                }
                
                if (cvcInput) {
                    cvcInput.addEventListener('input', function() {
                        this.value = this.value.replace(/[^0-9]/g, '');
                    });
                }
            }, 100);
        }

        // Demo form formatting functions
        function formatCardNumber(input) {
            let value = input.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let formattedInputValue = value.match(/.{1,4}/g)?.join(' ') || value;
            input.value = formattedInputValue;
        }
        
        function formatExpiry(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + ' / ' + value.substring(2, 4);
            }
            input.value = value;
        }
        
        // Payment processing function
        async function processPayment() {
            const cardholderName = document.getElementById('cardholder-name').value.trim();
            const nextBtn = document.getElementById('next-btn') || document.getElementById('payment-button');
            const paymentProcessing = document.getElementById('payment-processing');
            
            if (!cardholderName) {
                alert('กรุณากรอกชื่อผู้ถือบัตร');
                document.getElementById('cardholder-name').focus();
                return;
            }

            // Show loading state
            if (nextBtn) {
                nextBtn.disabled = true;
                nextBtn.textContent = 'กำลังประมวลผล...';
            }
            if (paymentProcessing) {
                paymentProcessing.classList.remove('hidden');
            }

            try {
                // Check if we're in demo mode
                if (!stripe || !cardElement) {
                    // Demo mode - validate demo form fields
                    const demoCardNumber = document.getElementById('demo-card-number')?.value || '';
                    const demoExpiry = document.getElementById('demo-expiry')?.value || '';
                    const demoCvc = document.getElementById('demo-cvc')?.value || '';
                    
                    // Basic validation for demo
                    const cleanCardNumber = demoCardNumber.replace(/\s/g, '');
                    if (cleanCardNumber.length < 13) {
                        alert('กรุณากรอกหมายเลขบัตรให้ครบถ้วน (อย่างน้อย 13 หลัก)\n\nบัตรทดสอบ:\n• 4242 4242 4242 4242 (VISA)\n• 5555 5555 5555 4444 (Mastercard)');
                        document.getElementById('demo-card-number')?.focus();
                        throw new Error('Invalid card number');
                    }
                    
                    const cleanExpiry = demoExpiry.replace(/\s/g, '');
                    if (cleanExpiry.length < 5 || !cleanExpiry.includes('/')) {
                        alert('กรุณากรอกวันหมดอายุให้ถูกต้อง (MM/YY)\nตัวอย่าง: 12/28');
                        document.getElementById('demo-expiry')?.focus();
                        throw new Error('Invalid expiry date');
                    }
                    
                    if (demoCvc.length < 3) {
                        alert('กรุณากรอก CVC ให้ครบถ้วน (3-4 หลัก)\nตัวอย่าง: 123');
                        document.getElementById('demo-cvc')?.focus();
                        throw new Error('Invalid CVC');
                    }
                    
                    // Demo mode - simulate payment processing
                    console.log('Demo mode: Simulating payment processing');
                    console.log('Card Number:', demoCardNumber);
                    console.log('Expiry:', demoExpiry);
                    console.log('CVC:', demoCvc);
                    
                    setTimeout(() => {
                        alert('ชำระเงินสำเร็จ! (Demo Mode)\nหมายเลขรายการ: #DEMO' + Math.random().toString(36).substr(2, 6).toUpperCase() + '\nนี่เป็นการจำลองการชำระเงิน\n\nข้อมูลบัตร: ' + demoCardNumber);
                        
                        // In real application, redirect to success page
                        // window.location.href = '/order/success/' + orderId;
                    }, 2000);
                } else {
                    // Real Stripe processing
                    const {token, error} = await stripe.createToken(cardElement, {
                        name: cardholderName,
                    });

                    if (error) {
                        throw new Error(error.message);
                    }

                    // Here you would normally send the token to your server
                    console.log('Stripe token:', token);
                    
                    setTimeout(() => {
                        alert('ชำระเงินสำเร็จ!\nหมายเลขรายการ: #' + Math.random().toString(36).substr(2, 9).toUpperCase() + '\nระบบจะส่งอีเมลยืนยันภายใน 5 นาที');
                        
                        // In real application, redirect to success page
                        // window.location.href = '/order/success/' + orderId;
                    }, 2000);
                }
                
            } catch (error) {
                alert('เกิดข้อผิดพลาดในการชำระเงิน: ' + error.message);
                console.error('Payment error:', error);
            } finally {
                // Reset button state
                setTimeout(() => {
                    if (nextBtn) {
                        nextBtn.disabled = false;
                        updatePaymentButtonText();
                    }
                    if (paymentProcessing) {
                        paymentProcessing.classList.add('hidden');
                    }
                }, 2000);
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            showTab(0);
            updateRemoveButtons();
            updateAllPrices();
            
            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('[name="appointment_date"]').setAttribute('min', today);
            
            // Initialize Stripe elements (Test Mode)
            // ใส่ Stripe Test Publishable Key จริงที่นี่
            const stripeKey = 'pk_test_51IabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; // ตัวอย่าง - ต้องเปลี่ยนเป็น key จริง
            
            // Wait for Stripe.js to load and initialize
            function initializeStripe() {
                // Check if Stripe is available
                if (typeof Stripe === 'undefined') {
                    // Stripe not loaded yet, wait and try again
                    setTimeout(initializeStripe, 100);
                    return;
                }
                
                // Only initialize Stripe if we have a real key
                if (stripeKey && stripeKey !== 'pk_test_YOUR_PUBLISHABLE_KEY_HERE') {
                    try {
                        stripe = Stripe(stripeKey);
                        elements = stripe.elements();

                    // Create card element
                    cardElement = elements.create('card', {
                        style: {
                            base: {
                                fontSize: '16px',
                                color: '#424770',
                                fontFamily: '"LINE Seed Sans TH", sans-serif',
                                '::placeholder': {
                                    color: '#aab7c4',
                                },
                            },
                            invalid: {
                                color: '#9e2146',
                            },
                        },
                    });

                    // Mount card element
                    cardElement.mount('#card-element');

                    // Handle real-time validation errors from the card Element
                    cardElement.on('change', function(event) {
                        const displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                            displayError.classList.remove('hidden');
                        } else {
                            displayError.textContent = '';
                            displayError.classList.add('hidden');
                        }
                    });
                } catch (error) {
                    console.error('Stripe initialization error:', error);
                    // Show error in card element instead of alert
                    document.getElementById('card-element').innerHTML = '<div class="text-red-600 text-sm p-2">ไม่สามารถโหลดระบบชำระเงินได้ กรุณาติดต่อเจ้าหน้าที่</div>';
                }
                } else {
                    // Create realistic demo form immediately (not waiting for Stripe)
                    createDemoCardForm();
                }
            }
            
            // Start Stripe initialization
            initializeStripe();
        });
    </script>
@endsection