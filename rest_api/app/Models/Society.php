<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;

    protected $table = 'societies';
    protected $guarded = [];

    public function regional()
    {
        return $this->blongsTo(Regional::class);
    }

    public function consultation()
    {
        return $this->hasMany(Consultation::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccinations::class);
    }
}
