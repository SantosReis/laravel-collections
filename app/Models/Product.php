<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'car_products');
    }
}
