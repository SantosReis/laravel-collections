<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CollectionAdvanced extends Controller
{

    private $posts;

    public function __construct()
    {
        // $json = Http::get('https://www.reddit.com/r/vuejs.json')->json();
        $json = json_decode(\File::get(storage_path('vuejs.json')), true);
        
        $this->posts = collect($json['data']['children']);
    }

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
        $users = \App\Models\User::limit(10000)->get();
        // $users = \App\Models\User::take(10000)->get();
        // $users = \App\Models\User::get();
        // $users = DB::table('users')->limit(10000)->get();

        // dd($users);
        // die();

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

    public function stackQueueFilters(){
        // $collection = collect([
        //    8, 4, 3, 5, 'Dary', 'Developer', null, false, [], 2 
        // ]);

        // push(): appends an item to the end of the collection
        // $collection->push('Laravel', [1, 2, 3]);
        // dd($collection);

        // put(): sets the given key and value in the collectio
        // $collection->put('name', 'John Doe');
        // $collection->put('name', 'John Doe')->put('age', 33);
        // dd($collection);

        // forget(): removes an item from the collection by its key
        // $collection->forget(5);
        // $collection->forget(5)->forget(1)->forget(0); //ovelap
        // dd($collection);

        // pull(): removes an item from the collection by its key
        // but unlike forget() does not support overlap methods
        // $removedItem = $collection->pull(5);
        // dump($removedItem);
        // dd($collection);

        // pop(): removes and returns the last item from the collection
        // $removedItem = $collection->pop();
        // dump($removedItem);
        // dd($collection);

        // shift(): removes and returns the first item from the collectio
        // $removedItem = $collection->shift();
        // dump($removedItem);
        // dd($collection);

        // flip(): swaps the collection's keys with their corresponding values
        // does not work with boolean, null or arrays 
        // $collection = collect([8, 4, 3, 5, 'Dary', 'Developer', 2]);
        // $collection->flip();
        // dd($collection);

        return view('collections.stack-queue-filters');
    }


    // public function basicRedditcall(){
    //     // return $this->posts;

    //     return view('collections.filter', [
    //         'posts' => $this->posts
    //     ]);
    // }

    public function filter(){
        // return $this->posts;
        // dd($this->posts);

        $post = $this->posts->filter(function($post, $key) {
            if($post['data']['thumbnail'] == 'self' || $post['data']['thumbnail'] == 'default'){
                return false;
            }

            // return true; // return all items
            // return $post; // any linke
            return Str::contains($post['data']['url'], 'reddit.com'); //redit links only
        });

        // echo '<pre>';
        // echo $post->count();
        // echo $post->toJson();
        // die();

        return view('collections.filter', [
            'posts' => $post
        ]);
    }

    public function pluck(){
        // return $this->posts;
        // dd($this->posts);

        // if($this->posts->contains('data.thumbnail', 'self')){
        //     return view('collections.contains-empty');
        // }

        $images = $this->posts->filter(function($post, $key) {

            if($post['data']['thumbnail'] === 'self' || $post['data']['thumbnail'] === 'default'){
                return false;
            }
            return $post;
        })->pluck('data.thumbnail')->all();

        // $images = $this->posts->pluck('data.thumbnail')->reject("self")->reject("default")->all(); //reject() instead filter()

        // echo '<pre>';
        // echo $post->count();
        // dd($images);
        // die();

        return view('collections.pluck', [
            'images' => $images
        ]);
    }

    public function groupby(){
        // return $this->posts;
        // dd($this->posts);

        $images = $this->posts->filter(function($post, $key) {
            if(isset($post['data']['post_hint'])){
                return in_array($post['data']['post_hint'], ['link', 'self']);
            }
        })->groupBy('data.post_hint')->toArray();

        // echo '<pre>';
        // echo $post->count();
        // dd($images);
        // die();

        return view('collections.groupby', [
            'posts' => $images
        ]);
    }

    public function sortby(){
        // return $this->posts;
        // dd($this->posts);

        $posts= $this->posts->filter(function($post, $key) {
            // if(isset($post['data']['post_hint'])){
            //     return in_array($post['data']['post_hint'], ['link']);
            // }

            if($post['data']['thumbnail'] == 'self' || $post['data']['thumbnail'] == 'default'){
                return false;
            }
            return true;
            
        })->sortBy('data.title', true)->values();

        // echo '<pre>';
        // echo $posts->count();
        // echo $posts;
        // dd($posts);
        // die();

        return view('collections.sortby', [
            'posts' => $posts
        ]);
    }

    public function partition(){
        // return $this->posts;
        // dd($this->posts);


        list($popularPosts, $regularPosts) = $this->posts->partition(function($post) {
            return $post['data']['ups'] > 10;
        });

        // echo '<pre>';
        // echo $posts->count();
        // echo $posts;
        // dd($posts);
        // die();

        return view('collections.partition', [
            'popularPosts' => $popularPosts->sortByDesc('data.ups'),
            'regularPosts' => $regularPosts->sortByDesc('data.ups')
        ]);
    }

    // pull(): removes an item from the collection by its key but unlike forget() does not support overlap methods
    // forget(): removes an item from the collection by its key
    // reject(): filters the collection using the given closure to remove from the resulting collection
    public function reject(){

        $posts = $this->posts->reject(function($post) {
            return $post['data']['ups'] < 10;
        })->sortByDesc('data.ups');

        return view('collections.reject', [
            'posts' => $posts,
        ]);
    }

    //contains() alternative but boolean return
    //first() alternative but returning just one row
    public function wherein(){

        $posts = $this->posts->wherein('data.post_hint', ['link', 'self'])->groupBy('data.post_hint')->toArray();

        return view('collections.wherein', [
            'posts' => $posts
        ]);
    }

    // partition() or groupby() alernative
    public function chunk(){

        $posts = $this->posts->chunk(2);

        return view('collections.chunk', [
            'posts' => $posts
        ]);
    }

    //contains() alternative but boolean return
    //wherein() alternative but returning in many rows as you with
    public function first(){

        // $firstPopularPost = $this->posts->first(function($post, $key){
        //     return $post['data']['ups'] > 10;
        // });

        $firstPopularPost = $this->posts->firstWhere('data.ups', '>', 10);

        return view('collections.first', [
            'post' => $firstPopularPost
        ]);
    }

}
