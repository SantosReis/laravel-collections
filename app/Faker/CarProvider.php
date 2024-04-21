<?php

namespace App\Faker;
use Faker\Provider\Base;

class CarProvider extends Base
{
    protected static $names = [
        'Audi',
        'BMW',
        'Citroën',
        'Mercedes',
        'Peugeot',
        'Porsche',
        'Renault',
    ];
    public function car(): string
    {
        return static::randomElement(static::$names);
    }
}