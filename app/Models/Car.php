<?php

namespace App\Models;

use App\Models\CarModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    // protected $hidden = ['name', 'founded', 'description', 'image_path', 'user_id'];
    // protected $visible = ['name', 'founded', 'description', 'image_path', 'user_id'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }
}
