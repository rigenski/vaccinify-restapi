<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index($spot_id)
    {
        $schedule = Schedule::where('spot_id', $spot_id)->get();

        return response()->json([
            'schedules' => ScheduleResource::collection($schedule)
        ], 200);
    }
}
