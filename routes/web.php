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
    function happyFunction() {
        dump(var: 1);
        yield 'One';
        dump(var: 2);

        dump(var: 3);
        yield 'Two';
        dump(var: 4);

        dump(var: 5);
        yield 'Three';
        dump(var: 6);
    }

    $return = happyFunction();

    foreach(happyFunction() as $result){

        if($result == 'Two') {
            return;
        }
        dump( var: $result);
    }
});