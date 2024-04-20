@extends('layouts.app')

@section('content')
  <div class="m-auto w-4/5 py-24">
      <div class="text-center">
          <h1 class="text-5xl uppercase bold">
              Cars
          </h1>
      </div>
  </div>

  <div class="w-5/6 py-10">
    <div class="m-auto">
      <span 
      class="uppercase text-blue-500 font-bold text-xs italic">
          Founded: 2020
      </span>

      <h2 class="text-gray-700 text-5xl hover:text-gray-500">
          <a href="/cars/audi">
              Audi
          </a>
      </h2>

      <p class="text-lg text-gray-700 py-6">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt doloremque corporis ullam quia qui consequuntur architecto illo perferendis quidem eum unde possimus dignissimos quaerat mollitia repellendus quisquam, reprehenderit necessitatibus atque.
      </p>

      <hr class="mt-4 mb-8">
    </div>
  </div>
@endsection