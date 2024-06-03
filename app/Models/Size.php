<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Size extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'system',
        'height',
        'weight',
        'flight_modifier',
        'stealth_modifier',
        'attack_modifier',
        'defense_modifier',
        'damage_modifier',
        'damage_reduction_modifier'
    ];

    /**
     * Get the races the size has
     */
    public function races()
    {
        return $this->hasMany(Race::class, 'size_id', 'id');
    }
}
