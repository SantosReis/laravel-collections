<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'car_models';

    protected $primaryKey = 'id';

    public function car() 
    {
        return $this->belongsTo(Car::class);
    }
}
