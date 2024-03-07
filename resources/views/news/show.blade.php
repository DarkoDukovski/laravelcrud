@extends('products.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>News View Details
                    <a class="btn btn-danger float-end" href="{{ route('news.index') }}"> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <p class="form-control">{{ $news->title }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Description:</label>
                        <p class="form-control">{{ $news->description }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <p class="form-control">{{ $news->status == 1 ? 'Active' : 'Inactive' }}</p>
                    </div>
                    <div class="mb-3">
                        <label>News Image</label>
                        <p class="form-control">
                            <img src="{{ asset('assets/images/' . $news->image) }}" alt="News Image" width="200">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
