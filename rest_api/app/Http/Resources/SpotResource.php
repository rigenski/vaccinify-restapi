<?php

namespace App\Http\Resources;

use App\Models\SpotVaccine;
use Illuminate\Http\Resources\Json\JsonResource;

class SpotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $avaiable_vaccines = SpotVaccine::where('spot_id', $this->id)->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'serve' => $this->serve,
            'capacity' => $this->capacity,
            'available_vaccines' => SpotVaccineResource::collection($avaiable_vaccines)
        ];
    }
}
