<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Universities;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use App\Models\University;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $products = Product::latest()->paginate(5); // Change 5 to the desired number of items per page
        // return view('products.index', compact('products'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
            $products = Product::with('university')->get();
            //    dd($products);
             return view('products.index', compact('products'));
            
    }
            


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    $universities = Universities::all();
    return view('products.create', compact('universities'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'course' => 'required',
            'dob' => 'required|date',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'grade' => 'required',
            'university'=> 'required'
        ]);

        // Store the image in the assets/images folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/images'), $imageName);

        $product = new Product;
        $product->name = $request->name;
        $product->email = $request->email;
        $product->phone = $request->phone;
        $product->course = $request->course;
        $product->dob = $request->dob;
        $product->grade = $request->grade;
        $product->detail = $request->detail;
        $product->image = $imageName;
        $product->university_id = $request->university;
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
        $universities = Universities::all();
        return view('products.edit', compact('product', 'universities'));
    }




    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            // Store the new image in the 'public' disk
            $image->storeAs('public', $imageName);
            // Update the product with the new image name
            $product->update([
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
                'image' => $imageName,
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'dob' => $request->input('dob'),
                'university_id' => $request->input('university_id'),
            ]);
            return redirect()->route('products.index')->with('success', 'Student updated successfully with a new image.');
        }
        // No new image uploaded, update other fields without touching the image
        $product->update([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => $request->input('status'),
            'dob' => $request->input('dob'),
            'university_id' => $request->input('university_id'),
        ]);
        return redirect()->route('products.index')->with('success', 'Student updated successfully without changing the image.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Delete the product
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}