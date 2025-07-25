@extends('layouts.app')

@section('container-class', 'policy-page')

@section('title', 'นโยบายความเป็นส่วนตัว - Marco Air')

@section('content')
    <!-- Header -->
    <div class="text-center mb-6">
        <div class="w-12 h-12 mx-auto mb-4 bg-green-600 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-900 mb-2">นโยบายความเป็นส่วนตัว</h1>
        <p class="text-sm text-gray-600">Marco Air (M.A.R.Co.)</p>
    </div>

    <!-- Privacy Policy Content -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="text-sm text-gray-700 leading-relaxed space-y-4">
            <section>
                <h2 class="font-semibold text-gray-900 mb-2">1. ข้อมูลที่เราเก็บรวบรวม</h2>
                <p>เราเก็บรวบรวมข้อมูลส่วนบุคคลต่อไปนี้:</p>
                <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
                    <li>ชื่อ นามสกุล และข้อมูลส่วนตัว</li>
                    <li>หมายเลขโทรศัพท์และอีเมล</li>
                    <li>ข้อมูลจาก LINE Login (รูปโปรไฟล์, ชื่อผู้ใช้)</li>
                    <li>ข้อมูลการใช้งานแอปพลิเคชัน</li>
                </ul>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">2. วัตถุประสงค์ในการใช้ข้อมูล</h2>
                <p>เราใช้ข้อมูลของท่านเพื่อ:</p>
                <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
                    <li>ให้บริการและปรับปรุงแอปพลิเคชัน</li>
                    <li>ติดต่อสื่อสารและส่งข่าวสาร</li>
                    <li>วิเคราะห์การใช้งานเพื่อพัฒนาบริการ</li>
                    <li>ปฏิบัติตามข้อกำหนดทางกฎหมาย</li>
                </ul>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">3. การเปิดเผยข้อมูล</h2>
                <p>เราจะไม่เปิดเผยข้อมูลส่วนบุคคลของท่านให้แก่บุคคลที่สาม ยกเว้น:</p>
                <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
                    <li>เมื่อได้รับความยินยอมจากท่าน</li>
                    <li>เพื่อปฏิบัติตามกฎหมายหรือคำสั่งศาล</li>
                    <li>เพื่อปกป้องสิทธิและความปลอดภัย</li>
                </ul>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">4. ความปลอดภัยข้อมูล</h2>
                <p>เราใช้มาตรการรักษาความปลอดภัยที่เหมาะสมเพื่อปกป้องข้อมูลของท่านจากการเข้าถึง การใช้
                    หรือการเปิดเผยโดยไม่ได้รับอนุญาต</p>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">5. สิทธิของเจ้าของข้อมูล</h2>
                <p>ท่านมีสิทธิในการ:</p>
                <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
                    <li>เข้าถึงและขอสำเนาข้อมูลส่วนบุคคล</li>
                    <li>ขอแก้ไขข้อมูลที่ไม่ถูกต้อง</li>
                    <li>ขอลบหรือจำกัดการประมวลผลข้อมูล</li>
                    <li>ถอนความยินยอมได้ตลอดเวลา</li>
                </ul>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">6. การติดต่อ</h2>
                <p>หากมีคำถามเกี่ยวกับนโยบายความเป็นส่วนตัว กรุณาติดต่อเราผ่านช่องทางที่ระบุในแอปพลิเคชัน</p>
            </section>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center">
        <button onclick="history.back()" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
            ← กลับ
        </button>
    </div>
@endsection
