@extends('layouts.app')

@section('content')

<div class="container text-center">
        <h1 class="mt-5">WELCOME TO <span class="text-primary">BLUE BOOK</span> DASHBORAD !</h1>
        <div class="row mt-4">
          <div class="col-md-4 mt-3">
            <a href="{{ route('categories.index') }}" style="text-decoration:none;">
              <div class="card p-4">
                <div class="card-body">
                  <i class="fa fa-list-ul fa-5x text-danger mb-3"></i>
                  <h4 class="text-danger">CATEGORIES</h4>
                  <h4 class="font-weight-bold text-danger">{{ $categories->count() }}</h4>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4 mt-3">
            <a href="{{ route('books.index') }}" style="text-decoration:none;">
              <div class="card p-4">
                <div class="card-body">
                  <i class="fa fa-book fa-5x text-primary mb-3"></i>
                  <h4 class="text-primary">BOOKS</h4>
                  <h4 class="font-weight-bold text-primary">{{ $books->count() }}</h4>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4 mt-3">
            <a href="{{ route('orders.index') }}" style="text-decoration:none;">
              <div class="card p-4">
                <div class="card-body">
                  <i class="fa fa-clipboard-list fa-5x text-success mb-3"></i>
                  <h4 class="text-success">ORDERS</h4>
                  <h4 class="font-weight-bold text-success">{{ $orders->count() }}</h4>
                </div>
              </div>
            </a>
          </div>

        </div>
      </div>

@endsection
