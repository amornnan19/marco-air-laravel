<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    /**
     * Show the terms and conditions page.
     */
    public function show()
    {
        return view('auth.terms');
    }

    /**
     * Accept the terms and conditions.
     */
    public function accept(Request $request)
    {
        $request->validate([
            'marketing_consent' => ['required', 'accepted'],
            'data_sharing_consent' => ['required', 'accepted'],
        ], [
            'marketing_consent.required' => 'กรุณายอมรับการรับข่าวสารและสิทธิประโยชน์',
            'marketing_consent.accepted' => 'กรุณายอมรับการรับข่าวสารและสิทธิประโยชน์',
            'data_sharing_consent.required' => 'กรุณายอมรับการส่งข้อมูลส่วนบุคคล',
            'data_sharing_consent.accepted' => 'กรุณายอมรับการส่งข้อมูลส่วนบุคคล',
        ]);

        $user = Auth::user();
        
        $user->update([
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'marketing_consent' => true,
            'data_sharing_consent' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'ยินดีต้อนรับสู่ Marco Air!');
    }
}