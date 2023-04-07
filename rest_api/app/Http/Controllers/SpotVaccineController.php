<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpotVaccineResource;
use App\Models\SpotVaccine;
use App\Models\SpotVaccines;
use Illuminate\Http\Request;

class SpotVaccineController extends Controller
{
    public function index($spot_id)
    {
        $spot_vaccines = SpotVaccine::where('spot_id', $spot_id)->get();

        return response()->json([
            'spot_vaccines' => SpotVaccineResource::collection($spot_vaccines)
        ], 200);
    }
}
