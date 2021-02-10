@if($errors->all())
@foreach($errors->all() as $error)
<div class="alert alert-danger text-center">
  {{ $error }}
</div>
@endforeach
@endif

@if(session()->has("success"))
<div class="alert alert-success text-center">
  <strong>{{ session()->get("success") }}</strong>
</div>
@endif

@if(session()->has("infos"))
<div class="alert alert-success text-center">
  <strong>{{ session()->get("infos") }}</strong>
</div>
@endif

@if(session()->has("errorLink"))
<div class="alert alert-warning text-center">
  <strong>{!! session()->get("errorLink") !!}</strong>
</div>
@endif
