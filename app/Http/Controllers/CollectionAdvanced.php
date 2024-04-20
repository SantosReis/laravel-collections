<?php

namespace App\Http\Controllers;

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


}
