
@extends('layouts.app')

@section('content')
<div class="container m-auto">
  <div class="row">
    <div class="col-12 col-md-6 offset-md-3">
      <div class="row pt-3">
      <div class="col-12">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">First Popular Posts</h1>
      </div>
    </div>
      <div class="row pb-3">
        <div class="col-12">
          <div class="p2 flex">
            <a href="{{ $post['data']['url'] }}" class="d-block text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 text-xl font-bold">
              {{ $post['data']['title'] }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
