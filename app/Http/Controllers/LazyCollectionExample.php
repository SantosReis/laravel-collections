<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Storage;

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

    public function writingfile()
    {
        $tmp = LazyCollection::times(10 * 10)
            ->flatMap(fn () => [
                ['user_id' => 1, 'name' => 'Jinfeng'],
                ['user_id' => 2, 'name' => 'Alice'],
            ])
            ->map(fn ($user, $index) => array_merge($user, [
                'timestamp' => now()->addSeconds($index)->toIsoString(),
            ]))
            ->map(fn ($entry) => json_encode($entry))
            ->each(fn ($json) => Storage::append('public/logins.json', $json))->toArray();

        dd($tmp);
    }
}
