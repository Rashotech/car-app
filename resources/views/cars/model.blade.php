@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Add Car Model
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
            <form action="/car/{{ $car->id }}/model" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="block">
                    <input type="file"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="image_path"
                           required
                    >
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="name"
                           placeholder="Model name..."
                           required
                    >
                    <input type="date"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="date"
                           placeholder="Production date..."
                           required
                    >
                    <input type="text"
                           class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                           name="engine"
                           placeholder="Engine..."
                           required
                    >
                    <button class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold" type="submit">
                        Add Model
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection