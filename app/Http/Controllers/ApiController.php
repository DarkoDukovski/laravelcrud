<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Universities;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        
        $initialResponse = Http::get('http://universities.hipolabs.com/search?country=United+States');
        $universities = $initialResponse->json();

        foreach ($universities as $university) {
            $universityName = $university['name'];
            
            
            if (!Universities::where('name', $universityName)->exists()) {
                $newUniversity = new Universities();
                $newUniversity->name = $universityName;
                $newUniversity->save();
            }
        }

        
        $showGetApiButton = true;

        
        $universitiesNames = Universities::pluck('name');

        return view('api.universities', compact('universitiesNames', 'showGetApiButton'));
    }

    public function fetchUniversities(Request $request)
    {
        
        $page = $request->input('page', 1);
        $response = Http::get('http://universities.hipolabs.com/search?country=United+States&page=' . $page);
        $universities = $response->json();

        
        return response()->json($universities);
    }

    public function search(Request $request)
    {
        
        $search = $request->input('search');

        
        $response = Http::get('http://universities.hipolabs.com/search?country=United+States', ['name' => $search]);
        $universities = $response->json();

        
        $universities = array_map(function($university) {
            return [
                'Name' => $university['name'],
                'Country' => $university['country'],
                'Code' => $university['alpha_two_code'],
                'Domain' => $university['domains'][0] ?? '',
                'Web Page' => $university['web_pages'][0] ?? ''
            ];
        }, $universities);


        $universities = $this->paginateUniversities($universities, 3000);

        
        $showGetApiButton = false;

        return view('api.universities', compact('universities', 'showGetApiButton'));
    }

    
    private function paginateUniversities($universities, $perPage)
    {
        $currentPage = Paginator::resolveCurrentPage('page');
        $currentItems = array_slice($universities, ($currentPage - 1) * $perPage, $perPage);
        $paginatedUniversities = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, count($universities), $perPage);
        $paginatedUniversities->setPath(request()->url());

        return $paginatedUniversities;
    }
}
