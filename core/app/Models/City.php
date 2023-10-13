<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->hasMany(Location::class);
    }

    public function division()
    {
        return $this->hasMany(Division::class, 'id');
    }

    protected $fillable = [
        'name', 'division_id'
    ];
}
