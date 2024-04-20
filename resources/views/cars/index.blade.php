@extends('layouts.app')

@section('content')
  <div class="m-auto w-4/5 py-24">
      <div class="text-center">
          <h1 class="text-5xl uppercase bold">
              Cars
          </h1>
      </div>
  </div>

  <div class="m-auto w-5/6 pt-10">
        <a 
            href="create"
            class="border-b-2 pb-2 border-dotted italic text-gray-500">
            Add a new brand &rarr;
        </a>
    </div>

  <div class="m-auto w-5/6 py-10">



    @foreach ($brands as $brand)
      <div class="m-auto">

        <div class="float-right">
          <a 
              class="border-b-2 pb-2 border-dotted italic text-green-500"
              href="cars/{{ $brand->id }}/edit">
              Edit &rarr;
          </a>

          <form action="/cars/{{ $brand->id }}" class="pt-3" method="POST">
              @csrf
              @method('delete')
              <button 
                  type="submit"
                  class="border-b-2 pb-2 border-dotted italic text-red-500">
                      Delete &rarr;
              </button>
          </form>
      </div>

        <span 
        class="uppercase text-blue-500 font-bold text-xs italic">
          Founded: {{ $brand->founded }}
        </span>

        <h2 class="text-gray-700 text-5xl hover:text-gray-500">
          <a href="/cars/{{ $brand->id }}">
            {{ $brand->name }}
          </a>
        </h2>

        <p class="text-lg text-gray-700 py-6">
        {{ $brand->description }}
        </p>

        <hr class="mt-4 mb-8">
      </div>
    @endforeach
  </div>
@endsection