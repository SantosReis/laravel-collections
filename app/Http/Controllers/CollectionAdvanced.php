<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CollectionAdvanced extends Controller
{
    public function index()
    {
        
        $filters = [
            ['some_filter' => true],
            ['some_filter2' => true],
            'filter2',
            true,
            false,
        ];

        //v1
        $count = 0;
        foreach($filters as $filter){
            if(is_array($filter)){
                foreach($filter as $option){
                    if($option !== false){
                        $count++;
                    }
                }
            } else{
                if ($filter !== false) {
                    $count++;
                }
            }
        }

        // echo $count;

        //v2
        $count = collect($filters)->flatten()->filter()->count();

        dd($count);


    }

    public function collectionsVersusArrays(){

        // $users = array_map('str_getcsv', file(public_path('users.csv')));
        $users = \App\Models\User::all()->take(10000);

        $time_start = microtime(as_float:true);
        $names = [];
        foreach($users->toArray() as $user){
            // $name = Str::of($user[1])->before(' ')->toString();
            $name = Str::of($user['name'])->before(' ')->toString();

            if(!in_array($name, ['Edgar', 'Jennyfer', 'Buster'])){
                if(!array_key_exists($name, $names)){
                    $names[$name] = 0;
                }
                $names[$name]++;
            }
        }
        arsort($names);

        // echo '<pre>';
        // print_r($names);
        // die();
        $time_end = microtime(as_float:true);
        echo 'Array result: ' . number_format($time_end - $time_start, 4) . 's<hr />';
 
        $time_start = microtime(as_float:true);
        $names = collect($users)
            // ->map(fn ($user) => Str::of($user[1])->before(' ')->toString());
            ->map(fn ($user) => Str::of($user->name)->before(' ')->toString())
            ->filter(fn ($value) => !in_array($value, ['Edgar', 'Jennyfer', 'Buster']))
            ->groupBy(fn ($value) => $value)
            ->mapWithKeys(fn ($value, $key) => [$key => count($value)])
            ->sortDesc();

        // dd($names->toArray());
        $time_end = microtime(as_float:true);
        echo 'Collections result: ' . number_format($time_end - $time_start, 4) . 's<hr />';

        // dd($names->toArray());
        return view('advanced.collections-versus-arrays', compact('names'));
    }

    public function filteringCollections(){
        $collection = collect([
            1, 2, 3, 4, '', 'Dary', null, false, 0, []
        ]);

        //contains() alike in_array()
        // dd($collection->contains(3)); //true 
        // dd($collection->contains(30)); //false

        $collection = collect([
            'name' => 'Alexander The Great',
            'age' => 33,
            'country' => 'Macedonia'
        ]);

        //except() alike unset()
        // dd($collection->except('age')->toArray());
        // dd($collection->except('age', 'country')->toArray());

        //only() alike in_array() but with return
        // dd($collection->only('age')->toArray());
        dd($collection->only('name', 'age')->toArray());
    }


}
