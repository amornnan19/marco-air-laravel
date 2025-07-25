@extends('layouts.mobile')

@section('title', 'Terms & Conditions - Marco Air')

@section('content')
    <!-- Header -->
    <div class="text-center mb-6">
        <div class="w-16 h-16 mx-auto mb-4">
            @if (auth()->user()->line_avatar)
                <img src="{{ auth()->user()->line_avatar }}" alt="Profile"
                    class="w-16 h-16 rounded-full object-cover border-2 border-blue-200">
            @else
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            @endif
        </div>
        <h1 class="text-xl font-bold text-gray-900 mb-2">ข้อกำหนดเงื่อนไขและนโยบาย</h1>
        <h2 class="text-lg font-semibold text-gray-800">ความปลอดภัยเป็นส่วนตัว M.A.R.Co.</h2>
    </div>

    <!-- Terms Content -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="text-sm text-gray-700 leading-relaxed space-y-4">
            <p>
                ทาง M.A.R.Co. จำเป็นต้องเก็บข้อมูลบางอย่างของคุณ เพื่อพัฒนาการบริการให้เหมาะสมกับคุณมากขึ้น
                ทางเรารับประกันว่าข้อมูลทั้งหมดของคุณจะถูกเก็บรักษาไว้อย่างดีและจะไม่ถูกเผยแพร่สู่สาธารณะและบุคคลภายนอก
            </p>


            <p>
                การใช้งานบริการจะถือว่าท่านยอมรับใน<a href="{{ route('terms.conditions') }}" target="_blank"
                    class="text-blue-600 underline">ข้อกำหนดและเงื่อนไข</a> และยินยอมรับข่าวสารจากบริษัท
                มาร์โกแอร์ จำกัด ซึ่งท่านสามารถยกเลิกได้ตามต้องการ
            </p>

            <p class="text-xs text-gray-500 pt-2">
                อ่านเพิ่มเติม:
                <a href="{{ route('privacy.policy') }}" target="_blank"
                    class="text-blue-600 underline">นโยบายความเป็นส่วนตัว</a> |
                <a href="{{ route('cookie.policy') }}" target="_blank"
                    class="text-blue-600 underline">นโยบายการใช้คุกกี้</a>
            </p>
        </div>
    </div>

    <!-- Consent Checkboxes -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('terms.accept') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Marketing Consent -->
            <div class="flex items-start space-x-3">
                <input type="checkbox" id="marketing_consent" name="marketing_consent" value="1"
                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                <label for="marketing_consent" class="text-sm text-gray-700 leading-relaxed">
                    <span class="text-red-500">*</span> ข้าพเจ้ายินยอมรับข่าวสารและสิทธิประโยชน์ ผ่านทางอีเมล, เอสเอ็มเอส,
                    แอปพลิเคชั่น, โซเชียลมิเดีย, โทรศัพท์ และไดเร็กเมลจากบริษัท มาร์โกแอร์ จำกัด
                </label>
            </div>

            <!-- Data Sharing Consent -->
            <div class="flex items-start space-x-3">
                <input type="checkbox" id="data_sharing_consent" name="data_sharing_consent" value="1"
                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                <label for="data_sharing_consent" class="text-sm text-gray-700 leading-relaxed">
                    <span class="text-red-500">*</span> ข้าพเจ้ายินยอมรับส่งข้อมูลส่วนบุคคลให้กับบริษัท มาร์โกแอร์ จำกัด
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors mt-6">
                ยอมรับเงื่อนไขและดำเนินการต่อ
            </button>
        </form>
    </div>

    <!-- Footer -->
    <div class="text-center mt-4">
        <p class="text-xs text-gray-500">Marco Air (M.A.R.Co.)</p>
    </div>
@endsection
