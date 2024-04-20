<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $brand = Brand::all();
        return view('cars.index', ['brands' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'founded' => 'required|integer|min:0|max:2021',
            'description' => 'required',
        ]);
            
        Brand::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);

        // dd($brand);

        // dump($brand->carModels()->count());
        // $brand->carModels()->dd();
        // dump($brand->carModels()->get()->toArray());

        // dump($brand->headquarter()->count());
        // $brand->headquarter()->dd();
        // dump($brand->headquarter()->get()->toArray());
        // dump($brand->headquarter()->first()->toArray());

        // dump($brand->productionDate()->count());
        // dump($brand->productionDate()->get()->toArray());
        // die();
        // dd($brand->toArray());

    
        return view('cars.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('cars.edit')->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Brand::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description')
        ]);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect('/cars');
    }
}
