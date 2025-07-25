<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string|max:255',
            'link_url' => 'nullable|url|max:255',
            'button_text' => 'required|string|max:100',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'required|integer|min:0',
        ], [
            'title.required' => 'กรุณากรอกชื่อโปรโมชัน',
            'content.required' => 'กรุณากรอกเนื้อหาโปรโมชัน',
            'button_text.required' => 'กรุณากรอกข้อความปุ่ม',
            'end_date.after_or_equal' => 'วันที่สิ้นสุดต้องมากกว่าหรือเท่ากับวันที่เริ่มต้น',
            'sort_order.required' => 'กรุณากรอกลำดับการแสดง',
        ]);

        Promotion::create($request->all());

        return redirect()->route('admin.promotions.index')
            ->with('success', 'สร้างโปรโมชันเรียบร้อยแล้ว');
    }

    public function show(Promotion $promotion)
    {
        return view('admin.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string|max:255',
            'link_url' => 'nullable|url|max:255',
            'button_text' => 'required|string|max:100',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'required|integer|min:0',
        ], [
            'title.required' => 'กรุณากรอกชื่อโปรโมชัน',
            'content.required' => 'กรุณากรอกเนื้อหาโปรโมชัน',
            'button_text.required' => 'กรุณากรอกข้อความปุ่ม',
            'end_date.after_or_equal' => 'วันที่สิ้นสุดต้องมากกว่าหรือเท่ากับวันที่เริ่มต้น',
            'sort_order.required' => 'กรุณากรอกลำดับการแสดง',
        ]);

        $promotion->update($request->all());

        return redirect()->route('admin.promotions.index')
            ->with('success', 'อัพเดตโปรโมชันเรียบร้อยแล้ว');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'ลบโปรโมชันเรียบร้อยแล้ว');
    }
}