@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Create Car
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
            <form id="form" onsubmit="return handleData()" action="/cars" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <input type="file"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="image"
                           required
                    >
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="name"
                           placeholder="Brand name..."
                           required
                    >
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="founded"
                           placeholder="Founded..."
                           required
                    >
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="description"
                           placeholder="Description..."
                           required
                    >
                    <p>Car Products</p>
                    <div class="py-2" style="visibility: hidden; color:red;" id="option_error">
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