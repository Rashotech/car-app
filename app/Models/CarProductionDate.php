<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarProductionDate extends Model
{
    use HasFactory;

    protected $fillable = ['created_at'];

    public $timestamps = false;

}
