
@extends('layouts.app')

@section('content')
<div class="container m-auto">
  <div class="row">
    <div class="col-12 col-md-6 offset-md-3">
      <div class="row pt-3">
      <div class="col-12">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">Grouped Posts</h1>
      </div>
    </div>
    @foreach ($posts as $type => $children)
      @include('collections.groupby.' . $type)
    @endforeach
    </div>
  </div>
</div>

@endsection
