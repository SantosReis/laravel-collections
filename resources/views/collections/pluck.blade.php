
@extends('layouts.app')

@section('content')
<div class="container m-auto">
  <div class="row">
    <div class="col-12 col-md-6 offset-md-3">
      <div class="row pt-3">
      <div class="col-12">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">Plucked Posts images</h1>
      </div>
    </div>
    @foreach ($images as $image)
      <div class="row pb-3">
        <div class="col-12">
          <div class="p2 flex justify-center items-center">
            <img class="d-block mw-100" width="500" src="{{ $image }}">
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
</div>

@endsection
