@extends('layouts.app')

@section('content')

<section class=" container-fluid mt-5 mb-5">
  <div class="row">
    <div class="col-md-3 d-flex-justify-content-start mb-3">
      <ul class="list-group border border-primary">
        <li class="list-group-item active"><i class="fas fa-list-ul"></i> Categories</li>
        @if($categories->count() == 0)
        <li class="list-group-item">No Category</li>
        @endif

        @foreach($categories as $category)
        <a href="{{ route('category.books', $category->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">{{ $category->name }} <span class="badge badge-primary badge-pill">{{ $category->books->count() }}</span> </a>
        @endforeach
     </ul>
    </div>

    <div class="col-md-9">
      @if(session()->has('success'))
      <div class="alert alert-success text-center">
        {!! session('success') !!}
      </div>
      @endif
        <div class="row">
          @forelse($books as $book)
          @isset($book->category)
          <div class="col mb-3">
            <div class="card" style="width: 18rem;height: 100%">
              <a href="{{ route('books.show', $book) }}"><img src="{{ asset('images/books/' . $book->image) }}" class="card-img-top" alt="..."></a>
              <div class="card-body">
                <div class="d-flex justify-content-start mt-2 mb-2">
                  <span class="badge badge-secondary">{{ $book->category->name }}</span>
                </div>
                <a href="{{ route('books.show', $book) }}" class="text-dark" style="text-decoration:none;"><h5 class="card-title">{{ $book->title }}</h5></a>
                <p class="d-flex flex row justify-content-center align-items-center">
                  <span class="text-info bg-muted border rounded border-muted p-2"> <strong>{{ $book->price }} $</strong> </span>
                  <span class="text-light border rounded ml-2 border-danger bg-danger p-2">
                    <strike>{{ $book->old_price }} $</strike>
                  </span>
                </p>
                <form  action="{{ route('cart.store') }}" method="post">
                  @csrf
                    <input type="hidden" name="id" value="{{ $book->id }}">
                    <input type="hidden" name="title" value="{{ $book->title }}">
                    <input type="hidden" name="price" value="{{ $book->price }}">
                    <input type="hidden" name="qty" value="1">
                  <button type="submit" class="btn btn-block btn-outline-primary" ><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                </form>
              </div>
            </div>
          </div>
          @endisset
        </div>
        <div class="d-flex justify-content-start">
          {{ $books->links() }}
        </div>
    </div>
  </div>
  @empty
  <div class="alert alert-info col-md-11 text-center">
    No products has been added yet !
  </div>
  @endforelse
</section>

@endsection
