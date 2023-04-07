<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    protected $table = 'spots';
    protected $guarded = [];

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function spot_vaccines()
    {
        return $this->hasMany(SpotVaccines::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
