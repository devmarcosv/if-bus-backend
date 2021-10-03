<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'line' => 'required|string|',
            'popularity' => 'nullable|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = Driver::create([
            'name' => $request->get('name'),
            'line' => $request->get('line'),
            'popularity' => $request->get('popularity')
        ]);
        return response()->json($user, 200);
    }

    public function index(): array
    {
        $query = Driver::with('users')->get();

        return $query->toArray();
    }
}
