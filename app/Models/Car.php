<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    // protected $hidden = ['name', 'founded', 'description', 'image_path', 'user_id'];
    // protected $visible = ['name', 'founded', 'description', 'image_path', 'user_id'];
}
