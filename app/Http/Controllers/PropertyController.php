<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;

class PropertyController extends Controller
{
    //
    public function index()
    {
        $properties = Property::all();
        return response()->json([
            'status' => true,
            'message' => 'Properties retrieved successfully',
            'data' => $properties
        ], 200);
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Property found successfully',
            'data' => $property
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'cost' => 'required',
            'avatar' => 'nullable', 'image',
        ]);

        // dd($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }


        // dd($request);

        if ($request->hasFile('avatar')) { 
            $avatar = $request->file('avatar')->store(options: 'avatars');
        }

        // $property = Property::create($request->all());
        $property = Property::create([
            'name' => $request->name,
            'description' => $request->description,
            'cost' => $request->cost,
            'avatar' => $avatar ?? null, 
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Property created successfully',
            'data' => $property
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'cost' =>'requred',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $property = Property::findOrFail($id);
        $property->update($request->all());
        // $property->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'cost' => $request->cost,
        //     // 'avatar' => $avatar ?? null, 
        // ]);

        return response()->json([
            'status' => true,
            'message' => 'roperty updated successfully',
            'data' => $property
        ], 200);
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Property deleted successfully'
        ], 204);
    }
}
