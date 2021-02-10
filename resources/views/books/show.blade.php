@extends('layouts.app')

@section('content')

<section class=" container-fluid mt-5 mb-5">

  <div class="row">

    <div class="col-md-9">
      @if(session()->has('success'))
      <div class="alert alert-success text-center">
        {!! session('success') !!}
      </div>
      @endif
      <h3 class="mb-3 font-weight-bold">{{ $book->title }}</h3>
      <div class="card mt-3">
        <div class="card-body">
          <div class="row">
            <div class="col-md-5">
               <img src="{{ asset('images/books/' . $book->image) }}" width="100%" class="rounded" alt="...">
            </div>
            <div class="col-md-7">
              <p class="border p-2">{{ $book->description }}</p>
              <div class="d-flex justify-content-start align-items-start">
                <span class="text-info bg-muted border rounded border-info p-2"> <strong>Price : {{ $book->price }} $</strong> </span>
                <span class="text-danger bg-muted border rounded border-danger p-2 ml-3"> <strong style="text-decoration:line-through;">Old Price : {{ $book->old_price }} $</strong> </span>
              </div>
                <span class="badge badge-secondary mt-4">Category :  {{ $book->category->name }}</span>
                  @if($book->stock > 0)
                  <span class="badge badge-success">Available</span>
                  @else
                  <span class="badge badge-warning">Not Available</span>
                  @endif
                  <br><br>
                  <div class="">
                    <div class="stars-outer">
                      <div class="stars-inner"></div>
                    </div>
                    <span class="number-rating"></span>
                  </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3">
        <h4>Comments</h4>
        <hr>
        @comments(['model' => $book, 'perPage' => 10])
      </div>
    </div>

    <div class="col-md-3">
      <div class="card mt-5">
        <div class="card-body">
          <form  action="{{ route('cart.store') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="hidden" name="id" value="{{ $book->id }}">
              <input type="hidden" name="title" value="{{ $book->title }}">
              <input type="hidden" name="price" value="{{ $book->price }}">
              <label for="">Choose Quantity</label>
              <input type="number" name="qty" value="1" max="{{ $book->stock }}" min="1" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" name="button"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection
