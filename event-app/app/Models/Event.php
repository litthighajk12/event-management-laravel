<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'date',
        'location',
        'capacity',
        'price',
        'image',
    ];

    /**
     * Get the registrations for this event.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
