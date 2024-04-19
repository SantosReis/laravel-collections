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
    function happyFunction($strings) {
        foreach($strings as $string){
            dump(var: 'start');
            yield $string;
            dump(var: 'end');
        }

    }

    foreach(happyFunction(['One', 'Two', 'Three']) as $result){

        if($result == 'Two') {
            return;
        }
        dump( var: $result);
    }
});