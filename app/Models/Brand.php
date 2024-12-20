<?php

namespace App\Models;

use App\Models\Engine;
use App\Models\Product;
use App\Models\CarModel;
use App\Models\Headquarter;
use App\Models\CarProductionDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

protected $table = 'brands';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    // protected $hidden = ['name', 'founded', 'description', 'image_path', 'user_id'];
    // protected $visible = ['name', 'founded', 'description', 'image_path', 'user_id'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }

    public function headquarter()
    {
        return $this->hasOne(Headquarter::class);
    }

    //Define a has many through relationship
    public function engines()
    {
        return $this->hasManyThrough(
                Engine::class,
                CarModel::class,
                'brand_id', //Foreign key on CarModel table
                'model_id' //Foreign key on Engine table
            );
    }

    //Define a has one through relationship
    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'brand_id',
            'model_id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'car_products');
    }
}
