@extends('products.layout')

@section('content')
    <div class="row" style="padding-top: 70px;"> 
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Add Student</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Grade</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Date of Birth</th>
            <th>University ID</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            
            <td>{{ $product->image }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->grade }}</td>
            <td>{{ $product->email }}</td>
            <td>{{ $product->phone }}</td>
            <td>{{ $product->course }}</td>
            <td>{{ $product->dob }}</td>
           
           @isset($product->university->name)
            <td>{{ $product->university->name }}</td>
           @endisset 
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
   
      
@endsection
