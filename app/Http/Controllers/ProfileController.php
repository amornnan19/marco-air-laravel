<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the profile update form.
     */
    public function edit()
    {
        return view('auth.update-profile');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'size:10', 'regex:/^[0-9]{10}$/'],
        ], [
            'first_name.required' => 'กรุณากรอกชื่อจริง',
            'last_name.required' => 'กรุณากรอกนามสกุล',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'phone.size' => 'เบอร์โทรศัพท์ต้องมี 10 หลัก',
            'phone.regex' => 'เบอร์โทรศัพท์ต้องเป็นตัวเลขเท่านั้น',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
        ]);

        // Check if user needs to accept terms
        if (! $user->terms_accepted) {
            return redirect()->route('terms.show');
        }

        return redirect()->route('dashboard')->with('success', 'อัปเดตข้อมูลโปรไฟล์เรียบร้อยแล้ว');
    }
}
