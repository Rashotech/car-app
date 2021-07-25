@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                {{ $car->name }}
            </h1>
        </div>

        <div class="m-auto w-5/6 py-10">
            <div class="m-auto">
                <span class="uppercase text-blue-500 font-bold text-xs italic">
                    Founded: {{ $car->founded }}
                </span>

                <img 
                    src="{{ $car->image_path }}" 
                    alt=""
                    class="w-6/12 mt-4 mb-2 shadow-xl"    
                >

                <p class="text-lg text-gray-700 py-6">
                    {{ $car->description }}
                </p>

                <p class="left my-10">
                    Product Types:
                    @forelse ($car->products as $product)
                        {{ $product->name }} ,
                    @empty
                        <p>
                            No Car Product Types
                        </p>
                    @endforelse
                </p>

                @if (isset(Auth::user()->id) && Auth::user()->id == $car->user_id)
                <div class="pt-10 mb-10">
                    <a href="/car/{{ $car->id }}/model" class="border-b-2 pb-2 border-dotted text-gray-500 mb-3 py-5">
                        Add a new Car Model &rarr;
                    </a>
                </div>
                @endif

                @if(count($car->carModels) !== 0)
                    <div class="text-center my-3">
                        <h1 class="text-3xl uppercase bold">
                            {{ $car->name }} Models
                        </h1>
                    </div>
                    <table class="table-auto text-center">
                        <tr class="bg-blue-100">
                            <th class="w-1/4 border-4 border-gray-500">
                                Image
                            </th>
                            <th class="w-1/4 border-4 border-gray-500">
                                Model
                            </th>
                            <th class="w-1/4 border-4 border-gray-500">
                                Engine
                            </th>
                            <th class="w-1/4 border-4 border-gray-500">
                                Manufactured Date
                            </th>
                        </tr>
                        @forelse ($car->carModels as $model)
                            <tr>
                                <td class="border-4 border-gray-500">
                                    <img 
                                        src="{{ $model->image_path }}" 
                                        alt=""
                                        class="w-12/12 mt-2 mb-2 shadow-xl"    
                                    >
                                </td>
                                <td class="border-4 border-gray-500">
                                    {{ $model->model_name }}
                                </td>
                                <td class="border-4 border-gray-500">
                                    @foreach ($car->engines as $engine)
                                        @if ($model->id == $engine->model_id)
                                            {{ $engine->engine_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="border-4 border-gray-500">
                                @foreach ($car->productionDate as $productionDates)
                                    @if ($model->id == $productionDates->model_id)
                                        {{ date('d-m-Y', strtotime($productionDates->created_at)) }}
                                    @endif
                                @endforeach
                                </td>
                            </tr>
                        @empty
                            <p>No car Models Found</p>
                        @endforelse
                    </table>
                    @else
                        <p>No car Models Found</p>
                @endif
                <hr class="mt-4 mb-6">
            </div>
        </div>
    </div>
@endsection