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
                  Add a new book
                </div>
                <div class="card-body">
                  <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Book Title</label>
                      <input type="text" name="title" placeholder="Book Title"class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Price</label>
                      <input type="number" name="price" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Old Price</label>
                      <input type="number" name="old_price" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Stock</label>
                      <input type="number" name="stock" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Choose a Category</label>
                      <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
