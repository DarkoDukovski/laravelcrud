<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\News;
class PublicController extends Controller
{
    public function index(): View
    {
        $activeNews = News::where('status', 1)->get();
        return view('welcome', compact('activeNews'));
    }
}