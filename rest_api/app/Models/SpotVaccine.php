<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotVaccine extends Model
{
    use HasFactory;

    protected $table = 'spot_vaccines';
    protected $guarded = [];

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}
