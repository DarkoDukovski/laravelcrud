<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        // Fetch initial universities data
        $initialResponse = Http::get('http://universities.hipolabs.com/search?country=United+States');
        $universities = $initialResponse->json();

        // Selecting required fields
        $universities = array_map(function($university) {
            return [
                'Name' => $university['name'],
                'Country' => $university['country'],
                'Code' => $university['alpha_two_code'],
                'Domain' => $university['domains'][0] ?? '',
                'Web Page' => $university['web_pages'][0] ?? ''
            ];
        }, $universities);

        // Paginate the data
        $universities = $this->paginateUniversities($universities, 3000);

        // Set $showGetApiButton to true to show the "Get API" button
        $showGetApiButton = true;

        return view('api.universities', compact('universities', 'showGetApiButton'));
    }

    public function fetchUniversities(Request $request)
    {
        // Fetch universities data
        {
    // Fetch universities data
    $page = $request->input('page', 1);
    $response = Http::get('http://universities.hipolabs.com/search?country=United+States&page=' . $page);
    $universities = $response->json();

    // Return JSON response
    return response()->json($universities);
}

        // Selecting required fields
        $universities = array_map(function($university) {
            return [
                'Name' => $university['name'],
                'Country' => $university['country'],
                'Code' => $university['alpha_two_code'],
                'Domain' => $university['domains'][0] ?? '',
                'Web Page' => $university['web_pages'][0] ?? ''
            ];
        }, $universities);

        // Paginate the data
        $universities = $this->paginateUniversities($universities, 3000);

        // Set $showGetApiButton to false to hide the "Get API" button
        $showGetApiButton = false;

        return view('api.universities', compact('universities', 'showGetApiButton'));
    }

    public function search(Request $request)
    {
        // Get search query from the request
        $search = $request->input('search');

        // Fetch filtered universities data based on the search query
        $response = Http::get('http://universities.hipolabs.com/search?country=United+States', ['name' => $search]);
        $universities = $response->json();

        // Selecting required fields
        $universities = array_map(function($university) {
            return [
                'Name' => $university['name'],
                'Country' => $university['country'],
                'Code' => $university['alpha_two_code'],
                'Domain' => $university['domains'][0] ?? '',
                'Web Page' => $university['web_pages'][0] ?? ''
            ];
        }, $universities);

        // Paginate the data
        $universities = $this->paginateUniversities($universities, 3000);

        // Set $showGetApiButton to false to hide the "Get API" button
        $showGetApiButton = false;

        return view('api.universities', compact('universities', 'showGetApiButton'));
    }

    // Helper function to paginate universities
    private function paginateUniversities($universities, $perPage)
    {
        $currentPage = Paginator::resolveCurrentPage('page');
        $currentItems = array_slice($universities, ($currentPage - 1) * $perPage, $perPage);
        $paginatedUniversities = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, count($universities), $perPage);
        $paginatedUniversities->setPath(request()->url());

        return $paginatedUniversities;
    }
}
