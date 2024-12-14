<?php

namespace App\Http\Controllers;

use App\Models\meal;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\StoremealRequest;
use App\Http\Requests\UpdatemealRequest;
use App\Http\Resources\MealResource;

class MealController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = meal::with(['category'])->get();
        return $this->ApiResponse(MealResource::collection($data), 'All meals successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremealRequest $request)
    {
        $data = meal::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        return $this->ApiResponse(MealResource::make($data), 'meal created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = meal::with(['category'])->findOrFail($id);
        return $this->ApiResponse(MealResource::make($data), 'meal show successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemealRequest $request, string $id)
    {
        $data = meal::findOrFail($id);
        $data->name = $request->input('name');
        $data->price = $request->input('price');
        $data->category_id = $request->input('category_id');
        $data->save();
        return $this->ApiResponse(MealResource::make($data), 'meal updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = meal::findOrFail($id);
        $data->delete();
        return $this->ApiResponse(null, 'meal deleted successfully');
    }
}
