<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([])
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = [
            'แอร์บ้าน',
            'แอร์สำนักงาน',
            'แอร์โรงงาน',
            'แอร์ติดรถยนต์',
            'อะไหล่แอร์',
            'อุปกรณ์แอร์'
        ];

        $brands = [
            'Mitsubishi',
            'Daikin',
            'LG',
            'Samsung',
            'Panasonic',
            'Carrier',
            'Central Air',
            'Tanin',
            'York',
            'Fujitsu'
        ];

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'btu' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'specifications' => 'nullable|string',
            'category' => 'required|string|max:255',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Process features and specifications
        $validated['features'] = $this->processArrayField($request->features);
        $validated['specifications'] = $this->processSpecifications($request->specifications);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Set default values
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        // Auto-calculate sort_order
        $maxSortOrder = Product::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxSortOrder + 1;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'สร้างสินค้าใหม่เรียบร้อยแล้ว');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = [
            'แอร์บ้าน',
            'แอร์สำนักงาน',
            'แอร์โรงงาน',
            'แอร์ติดรถยนต์',
            'อะไหล่แอร์',
            'อุปกรณ์แอร์'
        ];

        $brands = [
            'Mitsubishi',
            'Daikin',
            'LG',
            'Samsung',
            'Panasonic',
            'Carrier',
            'Central Air',
            'Tanin',
            'York',
            'Fujitsu'
        ];

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'btu' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'specifications' => 'nullable|string',
            'category' => 'required|string|max:255',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'boolean',
        ]);

        // Process features and specifications
        $validated['features'] = $this->processArrayField($request->features);
        $validated['specifications'] = $this->processSpecifications($request->specifications);

        // Handle image removal
        if ($request->remove_image && $product->image) {
            Storage::disk('public')->delete($product->image);
            $validated['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Set boolean values
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        // Remove the remove_image field before updating
        unset($validated['remove_image']);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'อัปเดตข้อมูลสินค้าเรียบร้อยแล้ว');
    }

    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'ลบสินค้าเรียบร้อยแล้ว');
    }

    private function processArrayField($input)
    {
        if (empty($input)) {
            return [];
        }

        // Split by new lines and filter empty lines
        $items = array_filter(
            array_map('trim', explode("\n", $input)),
            fn($item) => !empty($item)
        );

        return array_values($items);
    }

    private function processSpecifications($input)
    {
        if (empty($input)) {
            return [];
        }

        $specifications = [];
        $lines = array_filter(
            array_map('trim', explode("\n", $input)),
            fn($line) => !empty($line)
        );

        foreach ($lines as $line) {
            if (strpos($line, ':') !== false) {
                [$key, $value] = array_map('trim', explode(':', $line, 2));
                if (!empty($key) && !empty($value)) {
                    $specifications[$key] = $value;
                }
            }
        }

        return $specifications;
    }
}