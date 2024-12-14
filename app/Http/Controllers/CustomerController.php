<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\StorecustomerRequest;
use App\Http\Requests\UpdatecustomerRequest;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = customer::all();
        return $this->ApiResponse(CustomerResource::collection($data), 'All customers successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecustomerRequest $request)
    {
        $data = customer::create([
            'customer_rank' => $request->customer_rank,
        ]);
        return $this->ApiResponse(CustomerResource::make($data), 'customer created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = customer::findOrFail($id);
        return $this->ApiResponse(CustomerResource::make($data), 'customer show successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecustomerRequest $request, string $id)
    {
        $data = customer::findOrFail($id);
        $data->customer_rank = $request->input('customer_rank');
        $data->save();
        return $this->ApiResponse(CustomerResource::make($data), 'customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = customer::findOrFail($id);
        $data->delete();
        return $this->ApiResponse(null, 'customer deleted successfully');
    }
}
