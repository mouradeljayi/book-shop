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
                <a href="{{ route('categories.create') }}" class="btn btn-primary"> <i class="fas fa-plus fa-x2"></i> </a>
              </div>
              @if($categories->count())
              <table class="table table-hover table-bordered table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                      <div class="d-flex justify-content-start">
                        <a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('categories.destroy', $category->slug) }}" method="post">
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
                You have not added a category yet !
              </div>
              @endif
              <div class="d-flex justify-content-center align-items-center ">
                {{ $categories->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
