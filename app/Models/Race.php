<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Race extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'size_id',
        'description',
        'flavor',
        'system',
        'experience_cost',
        'hit_points',
        'book_id'
    ];

    /**
     * Get the talents that the race has through race_talents
     */
    public function race_talents()
    {
        return $this->belongsToMany(Talent::class);
    }

    /**
     * Get the senses that the race has through race_senses
     */
    public function race_senses()
    {
        return $this->belongsToMany(Sense::class);
    }

    /**
     * Get the types that the race has through race_senses
     */
    public function race_types()
    {
        return $this->belongsToMany(Type::class);
    }

    /**
     * Get the book the race belongs to
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    /**
     * Get the size the race belongs to
     */
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
