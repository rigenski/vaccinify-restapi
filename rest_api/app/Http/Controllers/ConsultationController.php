<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $consultations = Consultation::where('society_id', $user->society->id)->get();

        return response()->json([
            'consultations' => ConsultationResource::collection($consultations)
        ], 200);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        Consultation::create([
            'status' => 'pending',
            'disease_history' => $request->disease_history,
            'current_symptoms' => $request->current_symptoms,
            'society_id' => $user->society->id,
        ]);

        return response()->json([
            'message' => 'Consultation created success',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();

        $consultation = Consultation::find($id);

        $consultation->update([
            'status' => $request->status,
            'doctor_notes' => $request->doctor_notes,
            'doctor_id' => $user->doctor->id
        ]);

        return response()->json([
            'message' => 'Consultation updated success',
        ], 201);
    }
}
