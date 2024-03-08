<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $news = News::all();
        return view('news.index')->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }

        News::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'image' => $imageName,
        ]);

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): View
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news): View
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                $imagePath = public_path('assets/images/' . $news->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);

            $news->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $imageName,
            ]);

            return redirect()->route('news.index')->with('success', 'News updated successfully with a new image.');
        }

        $news->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully without changing the image.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): RedirectResponse
    {
        if ($news->image) {
            $imagePath = public_path('assets/images/' . $news->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully');
    }

    /**
     * Filter news based on status.
     */
    public function filterNews(Request $request): View
    {
        $status = $request->input('status');

        if ($status == 'all') {
            $news = News::all();
        } else {
            $news = News::where('status', $status)->get();
        }

        return view('news.filtered_news', compact('news'));
    }
}
