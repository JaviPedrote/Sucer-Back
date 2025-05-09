<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::included()->fitter()
         ->sort()
        ->getOrPaginate();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //!Regla de validacion
        $request->validate([
            'name' => 'required|max:255',
            'slug'=> 'nullable|alpha_dash|unique:categories,slug',
        ]);

        // 2) Obtener usuario
        $slug = $request->input('slug', Str::slug($request->name));

         // 4) Asegurarnos de que el slug sea único
    if (Category::where('slug', $slug)->exists()) {
        $slug .= '-' . time();
    }

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        return response()->json([
            'data' => CategoryResource::make($category),
            'message' => 'Category created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::included()->findOrFail($id);
        return CategoryResource::make($category);
    }


    public function update(Request $request, Category $category)
    {
        //!Regla de validacion
         $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->update($request->all());
        return response()->json([
            'data' => CategoryResource::make($category),
            'success' => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return CategoryResource::make($category);

    }
}
