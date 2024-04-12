<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Digimon extends Model
{
    use HasFactory;

    protected $table = 'digimons';

    protected $fillable = [
        'uuid',
        'name',
        'level',
        'img',
        'imgBaixada'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($digimon) {
            $digimon->uuid = (string) Str::uuid();
        });
    }
}
