@extends('auth.layouts')

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-primary">
                    <h5 class="card-title">Students</h5>
                    <i class="bi bi-people text-white" style="font-size: 3rem;"></i>
                    <p class="card-text">Total Students: </p> <!-- Display student count here -->
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-warning">
                    <h5 class="card-title">Total news</h5>
                    <i class="bi bi-newspaper fs-1 text-white" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-danger">
                    <h5 class="card-title">Active news</h5>
                    <i class="bi bi-newspaper fs-5 text-white" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-success">
                    <h5 class="card-title">Inactive news</h5>
                    <i class="bi bi-newspaper fs-5 text-white" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
