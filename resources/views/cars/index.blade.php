@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-12">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Cars
            </h1>
        </div>

        @if (Auth::user())
            <div class="pt-10">
                <a href="cars/create" class="border-b-2 pb-2 border-dotted text-gray-500">
                    Add a new Car &rarr;
                </a>
            </div>
        @else
            <p class="py-12 italic">
                Please Login to add a new Car
            </p>
        @endif

        <div class="w-5/6 py-10">
        @if(count($cars) !== 0)
           @foreach ($cars as $car)
                <div class="m-auto">
                    @if (isset(Auth::user()->id) && Auth::user()->id == $car->user_id)
                        <div class="float-right">
                            <a href="cars/{{ $car->id }}/edit"
                                class="border-b-2 pb-2 border-dotted italic text-green-500"
                            >
                                Edit &rarr;
                            </a>
                            <form action="/cars/{{ $car->id }}" method="POST" class="pt-3">
                                @csrf
                                @method('delete')
                                <button
                                    type="submit"
                                    class="border-b-2 pb-2 border-dotted italic text-red-500"
                                >
                                    Delete &rarr;
                                </button>
                            </form>
                        </div>
                    @endif

                    <img 
                        src="{{ $car->image_path }}"
                        class="w-40 mb-8 shadow-xl"
                    >

                    <span class="uppercase text-blue-500 font-bold text-xs italic">
                        Founded: {{ $car->founded }}
                    </span>
                    <h2 class="text-gray-700 text-5xl hover:text-gray-500">
                        <a href="cars/{{ $car->id }}">
                            {{ $car->name }}
                        </a>
                    </h2>
                    <p class="text-lg text-gray-700 py-6">
                        {{ $car->description }}
                    </p>
                    <p class="text-gray-400 py-2">
                        Posted by {{ $car->user->name }}
                    </p>
                    <hr class="mt-4 mb-6">
                </div>
           @endforeach
           @else 
            <div class="text-center">
                <h1 class="text-5xl uppercase bold py-50">
                    No Car Found
                </h1>
            </div>
           @endif
        </div>
        {{ $cars->links() }}
    </div>
@endsection