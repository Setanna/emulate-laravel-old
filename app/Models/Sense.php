<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Sense extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'system',
    ];

    /**
     * Get the races that the sense has through race_senses
     */
    public function race_senses()
    {
        return $this->belongsToMany(Race::class);
    }
}
