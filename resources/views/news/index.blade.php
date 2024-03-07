@extends('products.layout')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>News
                    <a class="btn btn-primary float-end" href="{{ route('news.create') }}"> Add News</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="container">
    <div class="row">
        @foreach ($news as $article)
        <div class="col-md-4 mt-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title text-center">{{ $article->title }}</h4>
                    <p class="card-text">{{ $article->description }}</p>
                    <p class="card-text">{{ $article->status == 1 ? 'Active' : 'Inactive' }}</p>
                    <div class='d-flex justify-content-center mb-3'>
                        <img class='news-image img-fluid' src="{{ asset('assets/images/' . $article->image)}}" width="300px" alt='News Image'>
                    </div>
                    <div class="mt-auto text-center">
                        <a href="{{ route('news.show', $article->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('news.edit', $article->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('news.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
