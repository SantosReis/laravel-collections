<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LazyCollectionExample;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lazy-collections', [LazyCollectionExample::class, 'index']);

Route::get('generator', function() {
    function happyFunction($string) {
        // return $string; // must be of type object, string given
        yield $string;
    }

    // return get_class(object: happyFunction(string: 'Supper Happy')); //check generators name
    return get_class_methods(happyFunction(string: 'Supper Happy')); //check generators methods
});