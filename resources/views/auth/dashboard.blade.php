@extends('auth.layouts')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
<div class="container mt-4" style="padding: 120px;">
    <div class="row justify-content-center"> <!-- Added justify-content-center to center align the cards -->
        <div class="col-lg-3 col-md-6">
            <div class="card card1">
                <div class="card-body bg-primary d-flex align-items-center justify-content-center flex-column"> <!-- Added flex-column to make the card content stack vertically -->
                    <h5 class="card-title text-white mb-3">Total students {{ $studentCount }}</h5>
                    <i class="bi bi-people text-white" style="font-size:3rem;"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card card2">
                <div class="card-body bg-warning d-flex align-items-center justify-content-center flex-column"> <!-- Added flex-column to make the card content stack vertically -->
                    <h5 class="card-title text-white mb-3">Total News {{ $totalNewsCount }}</h5>
                    <i class="bi bi-people text-white" style="font-size:3rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card3">
                <div class="card-body bg-danger d-flex align-items-center justify-content-center flex-column"> <!-- Added flex-column to make the card content stack vertically -->
                    <h5 class="card-title text-white mb-3">Active News {{ $activeNewsCount }}</h5>
                    <i class="bi bi-newspaper text-white" style="font-size:3rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card4">
                <div class="card-body bg-info d-flex align-items-center justify-content-center flex-column"> <!-- Added flex-column to make the card content stack vertically -->
                    <h5 class="card-title text-white mb-3">Inactive News {{ $inactiveNewsCount }}</h5>
                    <i class="bi bi-newspaper  text-white"style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
