@extends('products.layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>News Edit
                        <a class="btn btn-danger float-end" href="{{ route('news.index') }}"> Back</a>
                    </h4>
                </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-body">
        <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $news->title }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" style="max-height: 150px; overflow-y: auto;">{{ $news->description }}</textarea>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">--Select Status--</option>
                    <option value="0" {{ $news->status == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>Active</option>
                </select>
            </div>
            <div class="mb-3">
                <label>News Image</label>
                <input type="file" name="image" class="form-control">
                <img src="{{ asset('assets/images/' . $news->image) }}" alt="News Image" width="200">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mt-3">Update News</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection