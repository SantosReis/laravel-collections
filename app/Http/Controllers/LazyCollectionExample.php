<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class LazyCollectionExample extends Controller
{
    public function index(): View
    {
        //does break memory
        // $collection = Collection::times(10000000)
        //     ->map( callback: function ($number) {
        //         return pow( 2, $number);
        //     })
        //     ->all();

        //does not break memory
        $collection = LazyCollection::times(10000000)
            ->map( callback: function ($number) {
                return pow( 2, $number);
            })
            ->all();

        return view('lazy-collections');
    }
}
