<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    use HasFactory;

    protected $table = 'regionals';
    protected $guarded = [];

    public function society()
    {
        return $this->hasMany(Society::class);
    }

    public function spot()
    {
        return $this->hasMany(Spot::class);
    }
}
