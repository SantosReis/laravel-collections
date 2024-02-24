<?php

namespace App;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;


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

  //crossJoin()
  //Tinker \App\ExampleCollection::crossJoin()
  public static function crossJoin()
  {
    $collection = collect(value: [1, 2]);
    //option 1
    // return $collection->crossJoin(lists: ['a', 'b']);
    //option 2
    // return $collection->crossJoin(['a', 'b'], ['c', 'd']);
    //option 3
    $collection = collect(value: ['Ferrari', 'GT', 'F150']);
    return $collection->crossJoin(
      ['automatic', 'manual'],
      ['blue', 'black', 'white', 'yellow', 'gray'],
      [2018, 2019]
    );
    // )->count(); //get total
  }

  //diff()
  //Tinker \App\ExampleCollection::diff()
  public static function diff()
  {
    //option 1
    // $collection = collect(value: [1, 2, 3]);
    // return $collection->diff(items: [2, 4, 6]);

    //option 2
    // $collection = collect(value: ['apple', 'banana']);
    // return $collection->diff(items: ['pears', 'banana']);

    //option 3
    // $collection = collect(value: [10 => 'apple', 20 => 'banana']);
    // return $collection->diffAssoc(items: [30 => 'pears', 20 => 'banana']);

    //option 4
    $collection = collect(value: [10 => 'apple', 20 => 'banana']);
    return $collection->diffKeys(items: [30 => 'pears', 20 => 'bananas']);
  }

  //Tinker \App\ExampleCollection::diffUsing()
  public static function diffUsing()
  {
    //option 1: diffUsing
    // $collection = collect(value: [10, 25, 50]);
    // return $collection->diffUsing(items: [.1, .25], callback: function ($a, $b){
    //   dd($b* 100);
    // });

    //option 2: diffUsing
    // $collection = collect(value: [10, 25, 50]);
    // return $collection->diffUsing(items: [.1, .25], callback: function ($a, $b){
    //   // dump((int)($b* 100));
    //   // dump($a === (int)($b* 100) ? 0 : -1);
    //   return ($a === (int)($b* 100) ? 0 : -1);
    // });

    //option 3: diffAssocUsing
    // $collection = collect(value: [10 => 'apple', 25 => 'banana', 50 => 'coconut']);
    // return $collection->diffAssocUsing(items: ['.1' => 'apple', '.25' => 'pears'], callback: function ($a, $b){
    //   // dump((int)($b* 100));
    //   // dump($a === (int)($b* 100) ? 0 : -1);
    //   return ($a === (int)($b* 100) ? 0 : -1);
    // });

    //option 4: diffKeysUsing
    // $collection = collect(value: [10 => 'apple', 25 => 'banana', 50 => 'coconut']);
    // return $collection->diffKeysUsing(items: ['.1' => 'apple', '.25' => 'pears'], callback: function ($a, $b){
    //   // dump((int)($b* 100));
    //   // dump($a === (int)($b* 100) ? 0 : -1);
    //   return ($a === (int)($b* 100) ? 0 : -1);
    // });

    //option 5: diffUsing
    // $collection = collect(value: ['123A-G', '456A-G']);
    // return $collection->diffUsing(items: ['123AG'], callback: function ($a, $b){
    //   $code = str_replace(search: '-', replace: '', subject: $a);
    //   return ($code === $b) ? 0 : -1;
    // });

    //option 6: diffAssocUsing
    // $collection = collect(value: ['123A-G' => 10, '456A-G' => 25]);
    // return $collection->diffAssocUsing(items: ['123AG' => 10], callback: function ($a, $b){
    //   $code = str_replace(search: '-', replace: '', subject: $a);
    //   return ($code === $b) ? 0 : -1;
    // });

    //option 7: diffKeysUsing
    $collection = collect(value: ['123A-G' => 10, '456A-G' => 25]);
    return $collection->diffKeysUsing(items: ['123AG' => 10], callback: function ($a, $b){
      $code = str_replace(search: '-', replace: '', subject: $a);
      return ($code === $b) ? 0 : -1;
    });
  }

  /**
   * The tap method passes the collection to the given callback,
   * allowing you to "tap" into the collection at a specific point
   * and do something with the items while not affecting the collection itself.
   * The collection is then returned by the tap method:
   */
  //Tinker \App\ExampleCollection::tap()
  public static function tap()
  {
    //option 1
    // return collect(value: [1, 2, 3])
    //   ->reverse()
    //   ->tap(callback: function ($collection) {
    //     $collection->each(function($value){
    //       dump(var: 'In Tap' . $value);
    //     });
    //   })
    //   ->first();

      //option 2
      return collect(value: [1, 2, 3])
      ->reverse()
      ->tap(callback: function ($collection) {
        $collection->reverse()->each(function($value){
          dump(var: 'In Tap' . $value);
        });
      })
      ->first();
  }

  /**
   * 
   * The map method iterates through the collection and passes 
   * each value to the given callback. The callback is free to 
   * modify the item and return it, thus forming a new 
   * collection of modified items
   */
  //map() does not change key values
  //does not modify original array
  //Tinker \App\ExampleCollection::map()
  public static function map()
  {
    //option 1
    // return collect(value: [1, 2, 3, 4])
    //   ->map(callback: function($item) {
    //     return $item * 10;
    //   });

    //option 2 (remain orignal value)
    // $data = collect(value: [1, 2, 3, 4]);
    // $newCollection = $data->map(callback: function($item) {
    //     return $item * 10;
    //   });
    // // return $data;
    // return $newCollection;

    //option 3
    // return collect(value: [1, 2, 3, 4])
    //   ->map(callback: function($item, $key) {
    //     return $item * $key;
    //   });

    //option 4
    return collect(value: [
      'value1' => 'first',
      'value2' => 'second',
    ])->map(callback: function ($item, $key) {
      // return $item . ' ' . $key;
        return null;
    });
  }

  //Tinker \App\ExampleCollection::mapWithKeys()
  public static function mapWithKeys()
  {
    //option 1
    // return collect(value: [
    //   'value1' => 'first',
    //   'value2' => 'second',
    // ])->mapWithKeys(callback: function($item, $key){
    //   return [$item => $key];
    // });

    //option 2
    // return collect(value: [
    //   'value1' => 'first',
    //   'value2' => 'second',
    // ])->mapWithKeys(callback: function($item, $key){
    //   if($key == 'value2'){
    //     return [];
    //   }
    //   return [$item => $key];
    // });

    //option 3
    return collect(value: [
      'value1' => 'first',
      'value2' => 'second',
    ])->mapWithKeys(callback: function($item, $key){
      return [
        $key => $item,
        $key . '_upper' => strtoupper(string: $item),
      ];
    });
  }
  

  //Tinker \App\ExampleCollection::mapWithKeys()
  public static function mapInto()
  {
    $data = collect(value: [1, 2, 3, 4]);
    //option 1
    // return $data->mapInto(class: Converter::class)
    //   ->map(callback: function($item){
    //     return $item->toCentimeters();
    //   });
    //option 2
    $newCollection = $data->mapInto(class: Converter::class)
      ->map(callback: function($item){
        return $item->toCentimeters();
      });
    return $newCollection;
  }



  //Tinker \App\ExampleCollection::mapSpread()
  public static function mapSpread()
  {
    //option 1
    // $collection = collect(value: [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    // return $collection->chunk(size: 2)
    //   ->mapSpread(callback: function ($a, $b){
    //     return $a*$b;
    //   });

    //option 2
    $collection = collect(value: [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    return $collection->chunk(size: 3)
      ->mapSpread(callback: function ($a, $b, $c){
        return [$a*$b => $c];
      });

  }

  //Tinker \App\ExampleCollection::mapToDictionary()
  public static function mapToDictionary()
  {
    $collection = collect(value: [
      ['product' => 'apples', 'price' => 59],
      ['product' => 'apples', 'price' => 69],
      ['product' => 'bananas', 'price' => 54],
      ['product' => 'bananas', 'price' => 94],
    ]);

    //option 1: mapToDictionary
    // return $collection->mapToDictionary(callback: function($item){
    //   return [$item['product'] => $item['price']];
    // });

    //option 2: mapToGroups
    // return $collection->mapToGroups(callback: function($item){
    //   return [$item['product'] => $item['price']];
    // });

    //option 3: mapToGroups+map+max
    return $collection->mapToGroups(callback: function($item){
      return [$item['product'] => $item['price']];
    })->map(callback: function($item){
      return $item->max();
    });
  }

  //Tinker \App\ExampleCollection::where()
  public static function where()
  {
    return collect(value: [
      ['product' => 'apples', 'price' => 50],
      ['product' => 'pears', 'price' => 50],
      ['product' => 'bananas', 'price' => 70],
      ['product' => 'coconuts', 'price' => 80],
    ])->where(key: 'price', operator: '>', value: 50); //option 3
    // ])->where(key: 'price', value: 50); //option 2
    //])->whereStrict(key: 'price', value: '50'); //option 1
  }

  //Tinker \App\ExampleCollection::whereBetween()
  public static function whereBetween()
  {
    return collect(value: [
      ['product' => 'apples', 'price' => 50],
      ['product' => 'pears', 'price' => 50],
      ['product' => 'bananas', 'price' => 70],
      ['product' => 'coconuts', 'price' => 80],
    // ])->whereBetween('price', [60, 80]);
    ])->whereNotBetween('price', [60, 80]);
  }

  //Tinker \App\ExampleCollection::whereBetween()
  public static function whereIn()
  {
    return collect(value: [
      ['product' => 'apples', 'price' => 50],
      ['product' => 'pears', 'price' => 50],
      ['product' => 'bananas', 'price' => 70],
      ['product' => 'coconuts', 'price' => 80],
    ])->whereIn('price', [70, 80]);
    // ])->whereInStrict('price', [60, 80]);
    // ])->whereNotIn('price', [60, 80]);
    // ])->whereNotInStrict('price', [60, 80]);
  }

  //Tinker \App\ExampleCollection::whereInstanceOf()
  public static function whereInstanceOf()
  {
    return collect(value: [
      new Collection(),
      new User(),
      new User(),
    ])->whereInstanceOf(type: User::class);
  }

  //TODO
  //Tinker \App\ExampleCollection::wrap()
  public static function wrap()
  {

    $everyThree = new Pivot();
     return $everyThree->everyThree(collection1: collect(value: [1, 2, 3, 4]), collection2: [5, 6, 7, 8]);
  }

  //Tinker \App\ExampleCollection::unwrap()
  public static function unwrap()
  {
    $everyThree = new Pivot();
    //option 1
    // return $everyThree->mergeArray(array1: collect(value: [1, 2, 3, 4]), array2: [5, 6, 7, 8]);
    //option 2
    return $everyThree->mergeArray(collect(value: [1, 2, 3, 4]), [5, 6, 7, 8], 'string');
  }

  //Tinker \App\ExampleCollection::filter()
  public static function filter()
  {
    //option 1
    // return collect(value: [1, 2, 3, 4, null, '', 0, false, []])->filter();
    //option 2
    // return collect(value: [1, 2, 3, 4])->filter(callback: function($value){
    //   return ($value % 2) == 0;
    // });
    //option 2
    return collect(value: [1, 2, 3, 4])->filter(callback: function($value, $key){
      return $key > 2;
    });
  }

  //Tinker \App\ExampleCollection::pluck()
  public static function pluck()
  {
    //option 1
    // return collect([
    //   ['product' => 'apples', 'price' => 50, 'quantity' => 5],
    //   ['product' => 'bananas', 'price' => 60, 'quantity' => 10],
    //   ['product' => 'oranges', 'price' => 70, 'quantity' => 15],
    //   ['product' => 'coconuts', 'price' => 80, 'quantity' => 25],
    // ])->pluck('price');
    //option 2
    // return collect([
    //   ['product' => 'apples', 'price' => 50, 'quantity' => 5],
    //   ['product' => 'bananas', 'price' => 60, 'quantity' => 10],
    //   ['product' => 'oranges', 'price' => 70, 'quantity' => 15],
    //   ['product' => 'coconuts', 'price' => 80, 'quantity' => 25],
    // ])->map(function($item){
    //   return Arr::only($item, ['product', 'quantity']);
    // });
    //option 3
    // return collect([
    //   ['product' => 'apples', 'price' => 50, 'quantity' => 5],
    //   ['product' => 'bananas', 'price' => 60, 'quantity' => 10],
    //   ['product' => 'oranges', 'price' => 70, 'quantity' => 15],
    //   ['product' => 'coconuts', 'price' => 80, 'quantity' => 25],
    // ])->map(function($item){
    //   return collect($item)->only(['product', 'quantity'])->all();
    // });
    //option 4: setting keys
    return collect([
      ['product' => 'apples', 'price' => 50, 'quantity' => 5],
      ['product' => 'bananas', 'price' => 60, 'quantity' => 10],
      ['product' => 'oranges', 'price' => 70, 'quantity' => 15],
      ['product' => 'coconuts', 'price' => 80, 'quantity' => 25],
    ])->mapWithKeys(function($item){
      return [
        $item['quantity'] => collect($item)->only(['product', 'quantity'])->all()
      ];
    });
  }

  //Tinker \App\ExampleCollection::firstWhere()
  public static function firstWhere()
  {
    return collect([
      ['product' => 'apples', 'price' => 50, 'quantity' => 5],
      ['product' => 'bananas', 'price' => 60, 'quantity' => 10],
      ['product' => 'oranges', 'price' => 70, 'quantity' => 15],
      ['product' => 'coconuts', 'price' => 80, 'quantity' => 25],
    //])->where('price', '50')->first(); //option 1
    // ])->firstWhere('price', '50'); //option 2
    ])->firstWhere('price', '>=', '50'); //option 3
  }

  //Tinker \App\ExampleCollection::zip()
  public static function zip()
  {
    //option 1
    // return collect([1, 2, 3, 4])->zip([5, 6, 7, 8]);
    //option 1
    return collect([1, 2, 3, 4])
      ->zip(
        [5, 6, 7, 8],
        ['a', 'b', 'c', 'd'],
        [null, 'f', 'g']
    );
  }

  //Tinker \App\ExampleCollection::sort()
  public static function sort()
  {
    //option 1
    // return collect([5, 7, 3, 9])->sort();
    //option 2
    // return collect(['A12', 'B54', 'B23', 'A43'])->sort();
    //option 3
    return collect(['A-43', 'B54', 'B-23', 'A43'])
      ->sort(function ($a, $b) {
        $code = str_replace('-', '', $a);
        return ($code < $b) ? -1: 1;
      });
  }

  //Tinker \App\ExampleCollection::firstWhere()
  public static function sortBy()
  {
    // return collect([
    //   ['product' => 'apples', 'price' => 50, 'quantity' => 5],
    //   ['product' => 'bananas', 'price' => 60, 'quantity' => 10],
    //   ['product' => 'oranges', 'price' => 70, 'quantity' => 15],
    //   ['product' => 'coconuts', 'price' => 80, 'quantity' => 25],
    // // ])->sortBy('price'); //option 1
    // ])->sortByDesc('price'); //option 2

    //option 3
    return collect([
      ['product' => 'apples', 'price' => 50, 'quantity' => 5, 'code' => 'A-30'],
      ['product' => 'bananas', 'price' => 60, 'quantity' => 10, 'code' => 'A20'],
      ['product' => 'oranges', 'price' => 70, 'quantity' => 15, 'code' => 'A-50'],
      ['product' => 'coconuts', 'price' => 80, 'quantity' => 25, 'code' => 'A-10'],
    ])->sortBy(function ($item) {
      return str_replace('-', '', $item['code']);
    });
  }

  //Tinker \App\ExampleCollection::groupBy()
  public static function groupBy()
  {

    //option 1
    // return collect([
    //   ['product' => 'apples', 'price' => 50, 'quantity' => 5, 'code' => 'A-30'],
    //   ['product' => 'bananas', 'price' => 60, 'quantity' => 10, 'code' => 'A20'],
    //   ['product' => 'oranges', 'price' => 70, 'quantity' => 15, 'code' => 'A-50'],
    //   ['product' => 'coconuts', 'price' => 80, 'quantity' => 25, 'code' => 'A-10'],
    //   ['product' => 'coconuts', 'price' => 85, 'quantity' => 9, 'code' => 'A-11'],
    //   ['product' => 'apples', 'price' => 55, 'quantity' => 35, 'code' => 'A-31'],
    // ])->groupBy('product');

    //option 2
    // return collect([
    //   'string1' => ['product' => 'apples', 'price' => 50, 'quantity' => 5, 'code' => 'A-30'],
    //   'string2' => ['product' => 'bananas', 'price' => 60, 'quantity' => 10, 'code' => 'A20'],
    //   'string3' => ['product' => 'oranges', 'price' => 70, 'quantity' => 15, 'code' => 'A-50'],
    //   'string4' => ['product' => 'coconuts', 'price' => 80, 'quantity' => 25, 'code' => 'A-10'],
    //   'string5' => ['product' => 'coconuts', 'price' => 85, 'quantity' => 9, 'code' => 'A-11'],
    //   'string6' => ['product' => 'apples', 'price' => 55, 'quantity' => 35, 'code' => 'A-31'],
    // ])->groupBy('product', true);

    //option 3
    return collect([
      ['code' => '123VG', 'name' => 'string1'],
      ['code' => '123-VG', 'name' => 'string2'],
      ['code' => '123 VG', 'name' => 'string3'],
      ['code' => '125 VG', 'name' => 'string4'],
    ])->groupBy(function($element) {
      return str_replace(['-', ' '], '', $element['code']);
    });
  }

  //Tinker \App\ExampleCollection::first()
  public static function first()
  {
    //option 1
    // return collect([1, 2, 3, 4])->first();
    // return collect([1, 2, 3, 4])->first(null, 1000);
    //option 2
    // return collect([1, 2, 3, 4])->first(function ($element) {
    //     return $element > 1;
    // });
    //option 3
    return collect([1, 2])->first(function ($element) {
      return $element > 3;
    }, 1000); //set a default value
  }

  //Tinker \App\ExampleCollection::last()
  public static function last()
  {
    //option 1
    // return collect([1, 2, 3, 4])->last();
    // return collect([1, 2, 3, 4])->last(null, 1000);
    //option 2
    // return collect([1, 2, 3, 4])->last(function ($element) {
    //     return $element < 4;
    // });
    //option 3
    return collect([1, 2])->last(function ($element) {
      return $element > 3;
    }, 1000); //set a default value
  }

  //Tinker \App\ExampleCollection::last()
  public static function isEmpty()
  {
    //option 1
    return collect([0, false, null])->isEmpty();

    //option 2
    // $data = collect([]);
    // // $data = collect([1, 2, 3, 4]);
    // if($data->isEmpty()){
    //   return 'No Items';
    // }

    // //option 3
    // if($data->isNotEmpty()){
    //   return 'We have items!';
    // }
    
  }

  //Tinker \App\ExampleCollection::reverse()
  public static function reverse()
  {
    //option 1
    // return collect([1, 2, 3, 4])->reverse();
    // return collect([1, 2, 3, 4])->reverse()->values();

    //option 2
    return collect([
      'key1' => 'string1',
      'key2' => 'string2',
      'key3' => 'string3',
    ])->reverse()->values();
    
  }

  //Tinker \App\ExampleCollection::take()
  public static function take()
  {
    //option 1
    // return collect([1, 2, 3, 4])->take(2);
    //option 2
    return collect([1, 2, 3, 4])->take(-2);
    
  }

  //Tinker \App\ExampleCollection::nth()
  public static function nth()
  {
    //option 1
    // return collect([1, 2, 3, 4, 5, 6])->nth(2);

    //option 2
    return collect([1, 2, 3, 4, 5, 6, 7, 8])->nth(2, 5); //offset as second param
    
  }

  //Tinker \App\ExampleCollection::only()
  public static function only()
  {
    //option 1
    // return collect([1, 2, 3, 4, 5, 6])->only(2);

    //option 2
    // return collect(['product' => 'coconuts', 'price' => 10, 'qty' => 45])->only('product');

    //option 3
    return collect(['product' => 'coconuts', 'price' => 10, 'qty' => 45])->only(['product', 'price']);

    
  }
}


class Converter
{
  private $amount;

  public function __construct($amount)
  {
    $this->amount = $amount;
  }

  public function toCentimeters()
  {
    return $this->amount * 2.54;
  }

}

class Pivot
{

  // public function everyThree($collection1, $collection2){
  //   return Collection::wrap(value: $collection1)->nth(step: 3)
  //     ->merge(
  //       items: Collection::wrap(value: $collection2)->nth(step: 3)
  //     );
  // }
  public function everyThree(...$collections){
    // return Collection::wrap(value: $collections)->map(callback: function($item){
    //   return Collection::wrap(value: $item)->nth(step: 3);
    // });

    return Collection::wrap(value: $collections)->flatMap(callback: function($item){
      return Collection::wrap(value: $item)->nth(step: 3);
    });
  }

  //option 1
  // public function mergeArray($array1, $array2){
  //   return array_merge(
  //     Collection::unwrap(value: $array1),
  //     Collection::unwrap(value: $array2),
  //   );
  // }

  //option 2
  // public function mergeArray(...$arrays){
  //   return collect(value: $arrays)->map(callback: function($item){
  //     // return array_wrap(value: Collection::unwrap(value: $item));
  //     return Collection::unwrap(value: $item);
  //   });
  // }

  //option 3
  public function mergeArray(...$arrays){
    return collect(value: $arrays)->flatMap(callback: function($item){
      // return array_wrap(value: Collection::unwrap(value: $item));
      return Collection::unwrap(value: $item);
    });
  }
}