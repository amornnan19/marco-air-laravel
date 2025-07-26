<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::ordered()->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'description' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon_color' => 'required|string|in:blue,green,orange,red,purple,yellow',
            'packages' => 'required|array|min:1',
            'packages.*.name' => 'required|string|max:255',
            'packages.*.description' => 'required|string',
            'packages.*.price' => 'required|numeric|min:0',
            'packages.*.unit' => 'required|string|max:50',
            'details' => 'required|array|min:1',
            'details.*' => 'required|string',
            'contact_phone' => 'nullable|string|max:20',
            'price_display' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        // Set sort order if not provided
        if (empty($validated['sort_order'])) {
            $validated['sort_order'] = (new Service)->calculateSortOrder();
        }

        // Filter out empty packages and details
        $validated['packages'] = array_filter($validated['packages'], function ($package) {
            return ! empty($package['name']) && ! empty($package['description']);
        });

        $validated['details'] = array_filter($validated['details']);

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'สร้างบริการสำเร็จแล้ว');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,'.$service->id,
            'description' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon_color' => 'required|string|in:blue,green,orange,red,purple,yellow',
            'packages' => 'required|array|min:1',
            'packages.*.name' => 'required|string|max:255',
            'packages.*.description' => 'required|string',
            'packages.*.price' => 'required|numeric|min:0',
            'packages.*.unit' => 'required|string|max:50',
            'details' => 'required|array|min:1',
            'details.*' => 'required|string',
            'contact_phone' => 'nullable|string|max:20',
            'price_display' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            // Delete old image
            if ($service->hero_image) {
                Storage::disk('public')->delete($service->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        // Filter out empty packages and details
        $validated['packages'] = array_filter($validated['packages'], function ($package) {
            return ! empty($package['name']) && ! empty($package['description']);
        });

        $validated['details'] = array_filter($validated['details']);

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'อัปเดตบริการสำเร็จแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete image if exists
        if ($service->hero_image) {
            Storage::disk('public')->delete($service->hero_image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'ลบบริการสำเร็จแล้ว');
    }
}
