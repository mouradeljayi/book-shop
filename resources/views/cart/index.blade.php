@extends('layouts.app')

@section('content')

<section class="container mt-5 mb-5">
  @if(session()->has('success'))
  <div class="alert alert-success text-center">
    {!! session('success') !!}
  </div>
  @endif
  @if(session()->has('info'))
  <div class="alert alert-info text-center">
    {!! session('info') !!}
  </div>
  @endif
  <div class="row">
    <div class="card col-md-12 p-3">
      <h4 class="text-secondary mb-3 mt-2 text-uppercase"><i class="fas fa-shopping-cart"></i> Shopping Cart</h4>
      @if(Cart::count() > 0)
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
            <td> <img src="{{ asset('images/books/' . $item->model->image) }}" alt="" width="80" height="100" class="rounded"> </td>
            <td>{{ $item->name }}</td>
            <td>
               <form class="d-flex flex-row" action="{{ route('cart.update', $item->model->id) }}" method="post">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id" value="{{ $item->rowId }}">
                  <input type="hidden" name="title" value="{{ $item->name }}">
                  <input type="number" name="qty" value="{{ $item->qty }}" max="{{ $item->model->stock }}" min="1" class="form-control mr-2">
                  <button type="submit" class="btn btn-warning" name="button"> <i class="fas fa-edit"></i> </button>
                </form>
            </td>
            <td>{{ $item->price }} $</td>
            <td>
              <form class="text-center" action="{{ route('cart.destroy', $item->model->id) }}" method="post">
                 @csrf
                 @method('DELETE')
                 <input type="hidden" name="id" value="{{ $item->rowId }}">
                 <input type="hidden" name="title" value="{{ $item->name }}">
                 <button type="submit" class="btn btn-danger" name="button"> <i class="fas fa-trash"></i> </button>
               </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="card col-md-12 mt-3 p-2">
      <div class="card-body d-flex justify-content-between">
        <span class="border border-primary text-primary p-2">TOTAL PRICE : {{ Cart::subtotal() }} $</span>
        <a href="{{ route('make.payment') }}" class="btn btn-dark p-2"><i class="fab fa-paypal"></i> CHECK OUT &nbsp;	<i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
  @else
  <div class="alert alert-info">
    Your Shopping Cart is Currently Empty !
  </div>
  @endif
</section>

@endsection
