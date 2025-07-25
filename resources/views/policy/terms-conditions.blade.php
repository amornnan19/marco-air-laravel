@extends('layouts.policy')

@section('title', 'ข้อกำหนดและเงื่อนไข - Marco Air')

@section('content')
    <!-- Header -->
    <div class="text-center mb-6">
        <div class="w-12 h-12 mx-auto mb-4 bg-blue-600 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-900 mb-2">ข้อกำหนดและเงื่อนไข</h1>
        <p class="text-sm text-gray-600">Marco Air (M.A.R.Co.)</p>
    </div>

    <!-- Terms Content -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="text-sm text-gray-700 leading-relaxed space-y-4">
            <section>
                <h2 class="font-semibold text-gray-900 mb-2">1. การยอมรับข้อกำหนด</h2>
                <p>การใช้บริการของ Marco Air หมายถึงการยอมรับข้อกำหนดและเงื่อนไขเหล่านี้ทั้งหมด
                    หากท่านไม่ยอมรับข้อกำหนดเหล่านี้ กรุณาอย่าใช้บริการของเรา</p>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">2. การใช้บริการ</h2>
                <p>ท่านสามารถใช้บริการของเราเพื่อวัตถุประสงค์ที่ถูกต้องตามกฎหมายเท่านั้น
                    ห้ามใช้บริการในทางที่ผิดกฎหมายหรือละเมิดสิทธิของผู้อื่น</p>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">3. ข้อมูลส่วนบุคคล</h2>
                <p>เราจะเก็บรักษาข้อมูลส่วนบุคคลของท่านตามนโยบายความเป็นส่วนตัวของเรา
                    ข้อมูลจะถูกใช้เพื่อพัฒนาบริการและการติดต่อสื่อสารกับท่าน</p>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">4. ความรับผิดชอบ</h2>
                <p>Marco Air จะไม่รับผิดชอบต่อความเสียหายใดๆ ที่เกิดขึ้นจากการใช้บริการ นอกเหนือจากที่กฎหมายกำหนด</p>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">5. การแก้ไขข้อกำหนด</h2>
                <p>เราขอสงวนสิทธิ์ในการแก้ไขข้อกำหนดเหล่านี้ได้ตลอดเวลา การแก้ไขจะมีผลทันทีเมื่อได้ประกาศบนเว็บไซต์</p>
            </section>

            <section>
                <h2 class="font-semibold text-gray-900 mb-2">6. การติดต่อ</h2>
                <p>หากมีคำถามเกี่ยวกับข้อกำหนดเหล่านี้ กรุณาติดต่อเราผ่านช่องทางที่ระบุไว้ในแอปพลิเคชัน</p>
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
