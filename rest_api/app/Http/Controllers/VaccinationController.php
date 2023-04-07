<?php

namespace App\Http\Controllers;

use App\Http\Resources\VaccinationResource;
use App\Http\Resources\VaccineResource;
use App\Models\Schedule;
use App\Models\SpotVaccine;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $vaccinations = Vaccination::where('society_id', $user->society->id)->get();

        if (count($vaccinations) == 1) {
            return response()->json([
                'vaccinations' => [
                    'first' => new VaccinationResource($vaccinations[0]),
                    'second' => null,
                ]
            ], 200);
        } else if (count($vaccinations) == 2) {
            return response()->json([
                'vaccinations' => [
                    'first' => new VaccinationResource($vaccinations[0]),
                    'second' => new VaccinationResource($vaccinations[1]),
                ]
            ], 200);
        } else {
            return response()->json([
                'vaccinations' => [
                    'first' => null,
                    'second' => null,
                ]
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'spot_id' => 'required',
            'date' => 'date|required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => [
                    'date' => 'The date does not match the format Y-m-d.',
                    'spot_id' => 'The spot id field is required.',
                ]
            ], 401);
        }

        $user = $request->user();

        $schedule = Schedule::where('spot_id', $request->spot_id)->where('date', $request->date)->first();

        $vaccine = SpotVaccine::where('spot_id', $request->spot_id)->where('status', 1)->first();

        $vaccinations = Vaccination::where('society_id', $user->society->id)->first();

        $spot_queue = Vaccination::where('schedule_id', $schedule->id)->orderBy('created_at', 'desc')->first();

        $vaccinations_last = Vaccination::where('society_id', $user->society->id)->orderBy('created_at', 'desc')->first();

        $vaccinations_all = Vaccination::where('society_id', $user->society->id)->orderBy('created_at', 'desc')->get();

        if (count($vaccinations_all) == 2) {
            return response()->json([
                'message' => 'Society has been 2x vaccinated',
            ], 401);
        }



        if ($vaccinations_last && $vaccinations_last->status == 'pending') {
            return response()->json([
                'message' => 'Your consultation must be accepted by doctor before',
            ], 401);
        } else {
            Vaccination::create([
                'status' => 'pending',
                'dose' => $vaccinations ? 2 : 1,
                'queue' => $spot_queue ? $spot_queue->queue + 1 : 1,
                'schedule_id' => $schedule->id,
                'vaccine_id' => $vaccine->id,
                'society_id' => $user->society->id,
            ]);

            return response()->json([
                'message' => 'User Vaccine created success',
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();

        $vaccination = Vaccination::find($id);

        $vaccination->update([
            'status' => $request->status,
            'doctor_id' => $user->doctor->id
        ]);

        return response()->json([
            'message' => 'Consultation updated success',
        ], 201);
    }
}
