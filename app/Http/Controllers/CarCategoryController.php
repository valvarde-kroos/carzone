<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use App\Models\CarCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // SELECT * FROM CAR_CATEGORIES;  ELOQUENT ORM
        $categories = CarCategory::all();
        return view('category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'categoryName'=>'required|string|unique:categoriess',
            'image' => 'required|image|max:2048' //2MB 2048KB
        ]);

        if($request->hasFile('image')){
            $filename = Str::slug($request->categoryName) . '-category-'. time(). '.' . $request->image->extension(); //mercedes-category-7695346.png
            $request->image->move(public_path('uploads/'), $filename);

            CarCategory::create([
                'categoryName' => $request->categoryName,
                'image' => $filename
            ]);

            return back()->with('success', 'Category Added Successfully');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(CarCategory $carCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarCategory $carCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarCategory $carCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarCategory $carCategory)
    {
        //
    }
}
