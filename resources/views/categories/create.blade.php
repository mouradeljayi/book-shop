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
                  <i class="fas fa-list-ul"></i> CATEGORIES
                </h3>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  Create a new category
                </div>
                <div class="card-body">
                  <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="text" name="name" placeholder="category name"class="form-control">
                    </div>
                    <button type="submit" name="button" class="btn btn-success">Create</button>
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
