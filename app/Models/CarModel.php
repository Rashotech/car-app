<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'car_models';
    
    protected $primaryKey = 'id';

    protected $fillable = ['model_name', 'image_path'];

    // A CAr model belongs to a car
    public function Car()
    {
        return $this->belongsTo(Car::class);
    }

    public function production_date()
    {
        return $this->hasOne(CarProductionDate::class, 'model_id');
    }

    public function engine()
    {
        return $this->hasOne(Engine::class, 'model_id');
    }
}
