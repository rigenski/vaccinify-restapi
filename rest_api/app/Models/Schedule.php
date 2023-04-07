<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $guarded = [];

    public function spot()
    {
        return $this->BelongsTo(Spot::class);
    }

    public function vaccination()
    {
        return $this->hasMany(Vaccination::class);
    }
}
