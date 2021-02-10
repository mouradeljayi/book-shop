@extends('layouts.app')

@section('content')
<div class="container-fluid">
  @if ($message = Session::get('success'))
<div class="alert alert-success text-center  mt-3">
  {{ $message }}
</div>
@endif
<div class="container-fluid mt-5 mb-3">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-8">
              <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-2">
                <h3 class="text-secondary">
                  <i class="fas fa-book"></i> BOOKS
                </h3>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  Update Book
                </div>
                <div class="card-body">
                  <form action="{{ route('books.update', $book) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Book Title</label>
                      <input type="text" name="title"  value="{{ $book->title }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" rows="8" cols="80" class="form-control">{{ $book->description }}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Price</label>
                      <input type="number" name="price" value="{{ $book->price }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Old Price</label>
                      <input type="number" name="old_price" value="{{ $book->old_price }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Stock</label>
                      <input type="number" name="stock" value="{{ $book->stock }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Choose a Category</label>
                      <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $book->category_id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" name="button" class="btn btn-success">Add Book</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
