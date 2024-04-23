<?php

use App\Http\Controllers\CarsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionAdvanced;
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

Route::resource('/cars', CarsController::class);

Route::get('/lazy-collections', [LazyCollectionExample::class, 'index']);
Route::get('/lazy-collections/loadlog', [LazyCollectionExample::class, 'readingFile']);
Route::get('/lazy-collections/loadlog2', [LazyCollectionExample::class, 'readingFile2']);
Route::get('/lazy-collections/writingfile', [LazyCollectionExample::class, 'writingfile']);
Route::get('/collections-advanced', [CollectionAdvanced::class, 'index']);
Route::get('/collections-vs-arrays', [CollectionAdvanced::class, 'collectionsVersusArrays']);
Route::get('/collections-filtering', [CollectionAdvanced::class, 'filteringCollections']);
Route::get('/collections/stack-queue-filters', [CollectionAdvanced::class, 'stackQueueFilters']);
Route::get('/collections/filter', [CollectionAdvanced::class, 'filter']);
Route::get('/collections/pluck', [CollectionAdvanced::class, 'pluck']);
Route::get('/collections/groupby', [CollectionAdvanced::class, 'groupby']);
Route::get('/collections/sortby', [CollectionAdvanced::class, 'sortby']);
Route::get('/collections/partition', [CollectionAdvanced::class, 'partition']);
Route::get('/collections/reject', [CollectionAdvanced::class, 'reject']);
Route::get('/collections/wherein', [CollectionAdvanced::class, 'wherein']);
Route::get('/collections/chunk', [CollectionAdvanced::class, 'chunk']);
Route::get('/collections/first', [CollectionAdvanced::class, 'first']);
Route::get('/collections/tap', [CollectionAdvanced::class, 'tap']);

Route::get('generator-iterator', function() {
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

Route::get('generator', function() {
    // function notHappyFunction($number){
    //     $return = [];
    //     for($i=1; $i<$number; $i++){
    //         $return[] = $i;
    //     }

    //     return $return;
    // }

    // foreach (notHappyFunction(number: 100000000) as $number){
    //     if($number % 1000 == 0){
    //         dump(var: 'hello');
    //     }
    // }
    function happiestFunction($number){
        $return = [];
        for($i=1; $i<$number; $i++){
            yield $i;
        }

        return $return;
    }

    foreach (happiestFunction(100000000) as $number){
        if($number % 1000 == 0){
            dump(var: 'hello');
        }
    }

});