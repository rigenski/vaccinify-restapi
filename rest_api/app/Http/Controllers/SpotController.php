<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpotDetailResource;
use App\Http\Resources\SpotResource;
use App\Models\Schedule;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $spot = Spot::where('regional_id', $user->society->regional_id)->get();

        return response()->json([
            'spots' => SpotResource::collection($spot)
        ], 200);
    }

    public function show($id)
    {
        $spot = Spot::find($id);

        $schedule = Schedule::where('date', date('Y-m-d'))->where('spot_id', $spot->id)->get()->firstOrFail();

        return response()->json([
            'date' => date('Y-m-d'),
            'spot' => new SpotDetailResource($spot),
            'vaccinations_count' => count($schedule->vaccination)
        ], 200);
    }
}
