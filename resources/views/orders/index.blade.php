@extends('layouts.app')

@section('content')
<div class="container-fluid">
  @if ($message = Session::get('success'))
<div class="alert alert-success text-center mt-3">
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
                  <i class="fas fa-clipboard-list"></i> ORDERS
                </h3>
              </div>
              @if($orders->count())
              <table class="table table-hover table-bordered table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">CLIENT</th>
                    <th scope="col">BOOK</th>
                    <th scope="col">QTY</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">PAID</th>
                    <th scope="col">DELIVERED</th>
                    <th scope="col">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                  <tr>
                    <td>{{ $order->id }}</td>
                    <td> {{ $order->user->name }} </td>
                    <td>{{ $order->book_title }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                      @if($order->paid)
                       <i class="fas fa-check text-success"></i>
                      @else
                       <i class="fas fa-times text-danger"></i>
                      @endif
                    </td>
                    <td>
                      @if($order->delivered)
                       <i class="fas fa-check text-success"></i>
                      @else
                       <i class="fas fa-times text-danger"></i>
                      @endif
                    </td>
                    <td>
                      <div class="d-flex justify-content-start">
                        @if(!$order->delivered)
                        <form action="{{ route('orders.update', $order) }}" method="post">
                          @csrf
                          @method('PUT')
                          <button type="submit" name="button" class="btn btn-success ml-2"><i class="fas fa-check"></i></button>
                        </form>
                        @endif
                        <form action="{{ route('orders.destroy', $order) }}" method="post">
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
                There is No order for the moment !
              </div>
              @endif
              <div class="d-flex justify-content-center align-items-center ">
                {{ $orders->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
