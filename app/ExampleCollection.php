<?php

namespace App;


class ExampleCollection
{
 
  //average() or avg()
  //The avg method returns the average value of a given key:
  //Tinker \App\ExampleCollection::average()
  public static function average()
  {

    //pure php option
    //return (10+20+30)/3;

    //option 1
    // $data = [10, 20, 30];
    // return collect(value: $data)->average();

    //option 2
    // $data = [
    //   ['price' => 15000],
    //   ['price' => 20000],
    //   ['price' => 10000],
    // ];
    // return collect(value: $data)->average(callback: 'price');

    //option 3
    $data = [
      ['price' => 15000, 'tax' => 500, 'active' => true],
      ['price' => 20000, 'tax' => 700, 'active' => false],
      ['price' => 10000, 'tax' => 900, 'active' => true],
    ];

    return collect(value: $data)->avg(callback: function($value){
      if(!$value['active']) {
        return null;
      }
      return $value['price'] + $value['tax'];
    });
  }
}