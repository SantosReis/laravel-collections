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

  //max()
  //Tinker \App\ExampleCollection::max()
  public static function max()
  {
    //option 1
    // $data = [10000, 20000, 30000];
    // return collect(value: $data)->max();

    //option 2
    // $data = [
    //   ['price' => 15000],
    //   ['price' => 20000],
    //   ['price' => 10000],
    // ];
    // return collect(value: $data)->max(callback: 'price');


    //option 3
    $data = [
      ['price' => 15000, 'tax' => 500, 'active' => true],
      ['price' => 20000, 'tax' => 700, 'active' => false],
      ['price' => 10000, 'tax' => 900, 'active' => true],
    ];

    return collect(value: $data)->max(callback: function($value){
      if(!$value['active']) {
        return null;
      }
      return $value['price'] + $value['tax'];
    });
  }

  //min()
  //Tinker \App\ExampleCollection::min()
  public static function min()
  {
    //option 1
    // $data = [10000, 20000, 30000];
    // return collect(value: $data)->min();

    //option 2
    // $data = [
    //   ['price' => 15000],
    //   ['price' => 20000],
    //   ['price' => 10000],
    // ];
    // return collect(value: $data)->min(callback: 'price');


    //option 3
    $data = [
      ['price' => 15000, 'tax' => 500, 'active' => true],
      ['price' => 20000, 'tax' => 700, 'active' => false],
      ['price' => 10000, 'tax' => 900, 'active' => true],
    ];

    return collect(value: $data)->min(callback: function($value){
      if(!$value['active']) {
        return null;
      }
      return $value['price'] + $value['tax'];
    });
  }

  //median()
  //Tinker \App\ExampleCollection::median()
  public static function median()
  {
    //option 1
    // $data = [10000, 20000, 30000];
    // return collect(value: $data)->median();

    //option 2
    $data = [
      ['price' => 15000],
      ['price' => 20000],
      ['price' => 10000],
    ];
    return collect(value: $data)->median(key: 'price');

  }

  //collapse()
  //Tinker \App\ExampleCollection::collapse()
  //only collapses the first array nested layer.
  public static function collapse()
  {
    $collection = collect(value: [
      [1, 2, 3],
      [4, 5, 6],
    ]);

    return $collection->collapse();

  }

  //chunk()
  //Tinker \App\ExampleCollection::chunk()
  public static function chunk()
  {
    $collection = collect(value: 
      [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    );

    //option 1
    return $collection->chunk(size: 3);

    //option 1
    // return $collection->chunk(size: 3)->first();

  }

  //combine()
  //Tinker \App\ExampleCollection::combine()
  public static function combine()
  {
    $keys = collect(value: 
      ['column1', 'column2'],
    );

    //option 1
    // return $keys->combine(values: ['value1', 'value2']);

    //option 2
    return $keys->combine(values: [
      ['value1' => 123, 'value3' => 789], 
      ['value2' => 456]
    ]);
    

  }

  //concat()
  //Tinker \App\ExampleCollection::concat()
  public static function concat()
  {
    $data = collect(value: ['value1']);

    //option 1
    // return $data->concat(source: ['value2']);
    //option 2
    // return $data->concat(source: ['value2'])->first();
    //option 3
    return $data->concat(source: ['key1' => 'value2']); //concat ignore keys

  }

  //contains()
  //Tinker \App\ExampleCollection::contains()
  public static function contains()
  {

    //option 1
    // return collect(value: ['value1'])->contains(key: 'value1');
    //option 2
    // return collect(value: ['key' => 'value1'])->contains(key: 'value1');
    //option 3
    // return collect(value: [
    //   ['other' => 'value1']
    //   ])->contains(key: 'other', operator: 'value1');
    //option 4
    return collect(value: [1, 2, 3, 4, 5])
      ->contains(key: function ($value, $key){
        return $value > 4;
      });

  }

  //containsStrict()
  //Tinker \App\ExampleCollection::containsStrict()
  public static function containsStrict()
  {

    //option 1
    // return collect(value: [15])->containsStrict(key: '15');
    //option 2
    return collect(value: ['  0015'])->containsStrict(key: ' 15');

  }

  //NOTE: count does not return an collection. It means must be last method to be called.
  //count()
  //Tinker \App\ExampleCollection::count()
  public static function count()
  {

    $data = [1, 2 => [5, 6], 3, 4];

    return collect(value: $data)->count();

  }
}