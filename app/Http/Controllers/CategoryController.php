<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = category::all();
        return $this->ApiResponse(CategoryResource::collection($data), 'All categories successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecategoryRequest $request)
    {
        $data = category::create([
            'name' => $request->name,
        ]);
        return $this->ApiResponse(CategoryResource::make($data), 'category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = category::findOrFail($id);
        return $this->ApiResponse(CategoryResource::make($data), 'category show successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoryRequest $request, string $id)
    {
        $data = category::findOrFail($id);
        $data->name = $request->input('name');
        $data->save();
        return $this->ApiResponse(CategoryResource::make($data), 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = category::findOrFail($id);
        $data->delete();
        return $this->ApiResponse(null, 'category deleted successfully');
    }
}
