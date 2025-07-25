<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // Get next sort order automatically
        $nextSortOrder = Promotion::max('sort_order') + 1;

        return view('admin.promotions.create', compact('nextSortOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_url' => 'nullable|url|max:255',
            'button_text' => 'required|string|max:100',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'required|integer|min:0',
        ], [
            'title.required' => 'กรุณากรอกชื่อโปรโมชัน',
            'content.required' => 'กรุณากรอกเนื้อหาโปรโมชัน',
            'image.image' => 'ไฟล์ต้องเป็นรูปภาพ',
            'image.mimes' => 'รูปภาพต้องเป็นไฟล์ jpeg, png, jpg หรือ gif เท่านั้น',
            'image.max' => 'ขนาดรูปภาพต้องไม่เกิน 2MB',
            'button_text.required' => 'กรุณากรอกข้อความปุ่ม',
            'end_date.after_or_equal' => 'วันที่สิ้นสุดต้องมากกว่าหรือเท่ากับวันที่เริ่มต้น',
            'sort_order.required' => 'กรุณากรอกลำดับการแสดง',
        ]);

        $data = $request->except(['image']);

        // Auto calculate sort_order if not provided or 0
        if (! isset($data['sort_order']) || $data['sort_order'] == 0) {
            $data['sort_order'] = Promotion::max('sort_order') + 1;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promotions', 'public');
        }

        Promotion::create($data);

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_url' => 'nullable|url|max:255',
            'button_text' => 'required|string|max:100',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'required|integer|min:0',
        ], [
            'title.required' => 'กรุณากรอกชื่อโปรโมชัน',
            'content.required' => 'กรุณากรอกเนื้อหาโปรโมชัน',
            'image.image' => 'ไฟล์ต้องเป็นรูปภาพ',
            'image.mimes' => 'รูปภาพต้องเป็นไฟล์ jpeg, png, jpg หรือ gif เท่านั้น',
            'image.max' => 'ขนาดรูปภาพต้องไม่เกิน 2MB',
            'button_text.required' => 'กรุณากรอกข้อความปุ่ม',
            'end_date.after_or_equal' => 'วันที่สิ้นสุดต้องมากกว่าหรือเท่ากับวันที่เริ่มต้น',
            'sort_order.required' => 'กรุณากรอกลำดับการแสดง',
        ]);

        $data = $request->except(['image', 'delete_image']);

        // Handle image deletion
        if ($request->has('delete_image') && $promotion->image) {
            Storage::disk('public')->delete($promotion->image);
            $data['image'] = null;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($promotion->image) {
                Storage::disk('public')->delete($promotion->image);
            }
            $data['image'] = $request->file('image')->store('promotions', 'public');
        }

        $promotion->update($data);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'อัพเดตโปรโมชันเรียบร้อยแล้ว');
    }

    public function destroy(Promotion $promotion)
    {
        // Delete image if exists
        if ($promotion->image) {
            Storage::disk('public')->delete($promotion->image);
        }

        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'ลบโปรโมชันเรียบร้อยแล้ว');
    }
}
