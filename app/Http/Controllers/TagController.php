<?php

namespace App\Http\Controllers;

use App\Models\tag;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\StoretagRequest;
use App\Http\Requests\UpdatetagRequest;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::all();
        return $this->ApiResponse(TagResource::collection($data), 'All tags successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretagRequest $request)
    {
        $data = Tag::create([
            'name' => $request->name,
        ]);
        return $this->ApiResponse(TagResource::make($data), 'tag created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Tag::findOrFail($id);
        return $this->ApiResponse(TagResource::make($data), 'tag show successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetagRequest $request, string $id)
    {
        $data = Tag::findOrFail($id);
        $data->name = $request->input('name');
        $data->save();
        return $this->ApiResponse(TagResource::make($data), 'tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Tag::findOrFail($id);
        $data->delete();
        return $this->ApiResponse(null, 'tag deleted successfully');
    }
}
