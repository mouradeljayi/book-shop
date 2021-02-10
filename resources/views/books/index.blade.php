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
                <a href="{{ route('books.create') }}" class="btn btn-primary"> <i class="fas fa-plus fa-x2"></i> </a>
              </div>
              @if($books->count())
              <table class="table table-hover table-bordered table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th scope="col">TITLE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">STOCK</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($books as $book)
                  <tr>
                    <td>{{ $book->title }}</td>
                    <td> <img src="{{ asset('images/books/' . $book->image) }}" width="60" height="60" class="fluid rounded" alt=""> </td>
                    <td>{{ $book->stock }}</td>
                    <td>{{ $book->price }}</td>
                    <td>
                      @if(isset($book->category))
                      {{ $book->category->name }}
                      @else
                      No Category
                      @endif
                    </td>
                    <td>
                      <div class="d-flex justify-content-start">
                        <a href="{{ route('books.edit', $book->slug) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('books.destroy', $book->slug) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" name="button" class="btn btn-danger ml-2"><i class="fas fa-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
              <div class="alert alert-info mt-3">
                You have not added a book yet !
              </div>
              @endif
              <div class="d-flex justify-content-center align-items-center ">
                {{ $books->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
