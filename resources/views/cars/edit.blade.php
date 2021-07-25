@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Edit Car Details
            </h1>
        </div>

        @if ($errors->any())
                <div class="w-4/8 m-auto text-center">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 list-none">
                            {{ $error }}
                        </li>
                    @endforeach
                </div>
        @endif

        <div class="flex justify-center pt-20">
            <form action="/cars/{{ $car->id }}" onsubmit="return handleData()" method="POST">
                @csrf
                @method('PUT')
                <div class="block">
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="name"
                           value="{{ $car->name }}"
                           required
                    >
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="founded"
                           value="{{ $car->founded }}"
                           required
                    >
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="description"
                           value="{{ $car->description }}"
                           required
                    >
                    <p>Car Products</p>
                    <div class="py-1" style="visibility: hidden; color:red;" id="option_error">
                        Please select at least an option
                    </div>
                    @foreach ($cars_types as $cars_type)
                        <div class="block mb-2 p-1 w-80 italic">
                            <input type="checkbox"
                                name="car_products[]"
                                value="{{ $cars_type->id }}"
                            >
                            <label for="{{ $cars_type->id }}"> {{ $cars_type->name }}</label><br>
                        </div>
                    @endforeach
                    <button class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection