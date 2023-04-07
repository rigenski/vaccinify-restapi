<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionalResource;
use App\Models\Doctor;
use App\Models\Regional;
use App\Models\Society;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        $user = User::create([
            "username" => $request->id_card_number,
            "password" => bcrypt($request->password),
            "role" => "society",
        ]);

        $society = Society::create([
            "id_card_number" => $request->id_card_number,
            "name" => $request->name,
            "born_date" => $request->born_date,
            "gender" => $request->gender,
            "address" => $request->address,
            "regional_id" => $request->regional,
            "user_id" => $user->id,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Register success',
            'token' => $token,
            'society' => $society
        ], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt(['username' => $request->id_card_number, 'password' => $request->password])) {
            return response()->json([
                'message' => "ID Card Number or Password incorrect",
            ], 401);
        }

        $user = User::where('username', $request->id_card_number)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($user->role == 'society') {
            $society = Society::where('user_id', $user->id)->firstOrFail();

            $regional = Regional::find($society->regional_id);

            return response()->json([
                'name' => $society->name,
                'born_date' => $society->born_date,
                'gender' => $society->gender,
                'address' => $society->address,
                'token' => $token,
                'regional' =>  new RegionalResource($regional)
            ], 200);
        } else if ($user->role == 'doctor') {
            $doctor = Doctor::where('user_id', $user->id)->firstOrFail();

            return response()->json([
                'name' => $doctor->name,
                'token' => $token,
            ], 200);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout success',
        ], 200);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ], 200);
    }
}
