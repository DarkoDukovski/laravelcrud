<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\News;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Count students
        $studentCount = Product::count();

        // Count news
        $totalNewsCount = News::count();

        // Count active news
        $activeNewsCount = News::where('status', true)->count();

        // Count inactive news
        $inactiveNewsCount = News::where('status', false)->count();

        // Return the dashboard view with counts
        return view('auth.dashboard', compact('studentCount', 'totalNewsCount', 'activeNewsCount', 'inactiveNewsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}