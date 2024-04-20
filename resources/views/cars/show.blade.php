@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                {{ $brand->name }}
            </h1>
        </div>

        <div class="py-10 text-center">
                <div class="m-auto">
                    <span class="uppercase text-blue-500 font-bold text-xs italic">
                        Founded: {{ $brand->founded }}
                    </span>

                    <p class="text-lg text-gray-700 py-6">
                        {{ $brand->description }}
                    </p>

                    <table class="table-auto">
                        <tr class="bg-blue-100">
                            <th class="w-1/4 border-4 border-gray-500">
                                Model
                            </th>
                            <th class="w-1/4 border-4 border-gray-500">
                                Engines
                            </th>
                            <th class="w-1/4 border-4 border-gray-500">
                                Date
                            </th>
                        </tr>

                        @forelse ($brand->carModels as $model)
                            <tr>
                                <td class="border-4 border-gray-500">
                                    {{ $model->model_name }}
                                </td>
                            </tr>
                        @empty
                            <p>
                                No models found!
                            </p>
                        @endforelse

                    </table>
                    
                    <hr class="mt-4 mb-8">
                </div>
        </div>
    </div>

@endsection