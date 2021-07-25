<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;
use App\Http\Requests\CreateValidationRequest;
use App\Http\Requests\CarModel;

class CarsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::latest()->paginate(5);
        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $car_types = Product::all();
        return view('cars.create', [
            'cars_types' => $car_types
        ]);
    }

       /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function car_model($id)
    {

        $car = Car::where('id', $id)->first();

        return view('cars.model', [
            'car' => $car
        ]);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function car_model_store(CarModel $request, $id)
    {
        $request->validated();

        $car = Car::find($id);

        $newImageName = time() . '-' . $request->name . '.' . $request->image_path->extension();
        
        $request->image_path->move(public_path('images'), $newImageName);

        $car->carModels()->create([
            'model_name' => $request->input('name'),
            'image_path' => $newImageName
        ]);

        $model = $car->carModels()->where('model_name', $request->input('name'))->first();

        $model->production_date()->create([
            'created_at' => $request->input('date')
        ]);

        $model->engine()->create([
            'engine_name' => $request->input('engine')
        ]);


        return redirect('/cars/'.$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateValidationRequest $request)
    {
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        
        $request->image->move(public_path('images'), $newImageName);

        $car = Car::Create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        $car_products = $request->input('car_products');
   
        $car->products()->attach($car_products);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car_types = Product::all();
        $car = Car::where('id', $id)->first();

        return view('cars.edit', [
            'cars_types' => $car_types,
            'car' => $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidationRequest $request, $id)
    {
        $request->validated();
        
        Car::where('id', $id)->update([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description')
        ]);

        $car_products = $request->input('car_products');
   
        $cars = Car::where('id', $id)->first();
  
        $cars->products()->sync($car_products);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::where('id', $id)->first();
        $car->delete();

        return redirect('/cars');
    }
}
