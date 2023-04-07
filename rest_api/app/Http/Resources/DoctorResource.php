<?php

namespace App\Http\Resources;

use App\Models\Doctor;
use App\Models\SpotVaccine;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $doctor = Doctor::find($this->id);

        return [
            'id' => $this->id,
            'role' => $doctor->user->role,
            'name' => $this->name,
        ];
    }
}
