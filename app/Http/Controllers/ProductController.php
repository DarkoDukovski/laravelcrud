<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5); // Change 5 to the desired number of items per page
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'course' => 'required',
            'dob' => 'required|date',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image in the assets/images folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/images'), $imageName);

        $product = new Product;
        $product->name = $request->name;
        $product->grade = $request->grade;
        $product->email = $request->email;
        $product->phone = $request->phone;
        $product->course = $request->course;
        $product->dob = $request->dob;
        $product->detail = $request->detail;
        $product->image = $imageName;
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'course' => 'required',
            'dob' => 'required|date',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image if it exists
            if ($product->image) {
                $imagePath = public_path('assets/images/' . $product->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $imageName);

            // Update the product with the new image
            $product->image = $imageName;
        }

        // Update other product fields
        $product->name = $request->name;
        $product->grade = $request->grade;
        $product->email = $request->email;
        $product->phone = $request->phone;
        $product->course = $request->course;
        $product->dob = $request->dob;
        $product->detail = $request->detail;
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Delete the product image if it exists
        if ($product->image) {
            $imagePath = public_path('assets/images/' . $product->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
