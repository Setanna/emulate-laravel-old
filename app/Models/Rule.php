<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Rule extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'flavour',
        'system'
    ];

    /**
     * Get the books that the rule has through book_rules
     */
    public function book_rules()
    {
        return $this->belongsToMany(Book::class);
    }
}
