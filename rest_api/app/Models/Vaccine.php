<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $table = 'vaccines';
    protected $guarded = [];

    public function vaccine_status()
    {
        return $this->hasMany(VaccineStatus::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccinations::class);
    }
}
