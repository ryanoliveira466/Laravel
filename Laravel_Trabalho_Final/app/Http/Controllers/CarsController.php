<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\User;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Cars::all();

        return response()->json([
            'success' => true,
            'msg' => 'Cars listed successfully',
            'carsCount' => $cars->count(),
            'cars' => $cars
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {
            $request->validate([
                'owner_id' => 'required|exists:users,id',
                'car_brand' => 'required|string',
                'car_name' => 'required|string',
                'car_year' => 'required|integer',
                'car_price' => 'required|numeric',
            ],
            [
                'owner_id.required' => 'Field owner is required',
                'owner_id.exists' => 'Field owner must be a valid user',
                'car_brand.required' => 'Field brand is required',
                'car_name.required' => 'Field name is required',
                'car_year.required' => 'Field year is required',
                'car_price.required' => 'Field price is required',
            ]);

            $cars = Cars::create([
                'owner_id' => $request['owner_id'],
                'car_brand' => $request['car_brand'],
                'car_name' => $request['car_name'],
                'car_year' => $request['car_year'],
                'car_price' => $request['car_price'],
            ]);

        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Failed to register car',
                'error' => $error->getMessage(),
            ],500);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Car registered successfully',
            'car' => $cars,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'owner_id' => 'required|exists:users,id',
                'car_brand' => 'required|string',
                'car_name' => 'required|string',
                'car_year' => 'required|integer',
                'car_price' => 'required|numeric',
            ],
            [
                'owner_id.required' => 'Field owner is required',
                'owner_id.exists' => 'Field owner must be a valid user',
                'car_brand.required' => 'Field brand is required',
                'car_name.required' => 'Field name is required',
                'car_year.required' => 'Field year is required',
                'car_price.required' => 'Field price is required',
            ]);

            $cars = Cars::findOrFail($id);
            $cars->update([
                'owner_id' => $request['owner_id'],
                'car_brand' => $request['car_brand'],
                'car_name' => $request['car_name'],
                'car_year' => $request['car_year'],
                'car_price' => $request['car_price'],
            ]);

        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Failed to update car',
                'error' => $error->getMessage(),
            ],500);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Car updated successfully',
            'car' => $cars,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cars = Cars::findOrFail($id);
            $users = User::findOrFail($cars['owner_id']);
            $carName = $cars['car_name'];
            $userName = $users['name'];
            $cars->delete($id);
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Failed to delete car',
                'error' => $error->getMessage(),
            ],500);
        }

        return response()->json([
            'success' => true,
            'msg' => "Car $carName from $userName deleted successfully",
            'car' => $cars,
        ],200);
    }
}
