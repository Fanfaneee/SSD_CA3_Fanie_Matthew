<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    // Colonnes autorisées pour l'insertion en masse
    protected $fillable = [
        'name',
        'image',
        'location',
        'latitude',
        'longitude',
        'genre',
        'lineup',
        'price',
        'start_date',
        'end_date',
    ];

    // Si lineup est stocké en JSON, le convertir automatiquement en tableau
    protected $casts = [
        'lineup' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function comments()
{
    return $this->hasMany(Comment::class);
}

public function favoriteFestivals()
{
    return $this->belongsToMany(Festival::class, 'favorites')->withTimestamps();
}

}


